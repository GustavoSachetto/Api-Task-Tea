<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Utils\Base64ImageConverter;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ForbiddenException;
use App\Exceptions\IntegrityException;
use App\Http\Requests\TaskImageRequest;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    private static int $limitItensPagination = 500;

    /**
     * Display a listing of the tasks with pagination.
     */
    public function index(Request $request)
    {
        $currentPage = $request->get('page');

        $key = "task_{$currentPage}_route";

        $tasks = Task::paginate(self::$limitItensPagination);

        return $this->cached($key, TaskResource::collection($tasks));
    }

    /**
     * Display a listing of the templates tasks that owned by the admin
     */
    public function templates(Request $request) 
    {
        $currentPage = $request->get('page');

        $key = "task_template_{$currentPage}_route";

        $tasks = Task::where('user_creator_id', 1)->paginate(self::$limitItensPagination); // id do admin

        return $this->cached($key, TaskResource::collection($tasks));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(TaskRequest $request)
    {
        $request->validated();
        $request->merge($this->getUserCreatorId($request));

        $task = Task::create($request->only(['title', 'description', 'tip', 'level', 'categories_id', 'user_creator_id']));

        return (new TaskResource($task))->additional([
            'message' => 'Tarefa cadastrada com sucesso.'
        ]);
    }

    /** 
     * Store a newly created task image in storage.
     */
    public function storeImage(string $id, TaskImageRequest $request)
    {
        $request->validated();

        $this->checkId($id);

        $task = Task::findOrFail($id);
        $this->checkUserCreatorId($task);

        $data = $request->only('image');
        $image = new Base64ImageConverter($data['image']);

        $imagePath = Storage::putFile('images/tasks', $image->tempName);
        $imageUrl = asset('storage/' . $imagePath);

        $task->update(['image' => $imageUrl]);

        return ['message' => 'Imagem salva com sucesso.', 'image_path' => $imageUrl];
    }

    /**
     * Display the specified task by id.
     */
    public function show(string $id)
    {
        $this->checkId($id);

        $task = Task::findOrFail($id);

        return new TaskResource($task);
    }

    /**
     * Display a listing of the tasks specified by category id.
     */
    public function search(string $id)
    {
        $this->checkId($id);

        $tasks = Task::where('categories_id', $id)->paginate(self::$limitItensPagination);

        return TaskResource::collection($tasks);
    }

    /**
     * Search for tasks linked by title or content.
     */
    public function searchTitleOrContent(string $value)
    {
        $data = Task::where('user_creator_id', Auth::user()->id)
            ->where(function ($query) use ($value) {
                $query->where('title', 'like', "%$value%")
                    ->orWhere('description', 'like', "%$value%");
            })
            ->paginate(self::$limitItensPagination);
    
        return TaskResource::collection($data);
    }

    /**
     * Display a listing of the tasks specified by authenticated user.
     */
    public function myTasks(Request $request)
    {
        $currentPage = $request->get('page');

        $tasks = Task::where('user_creator_id', Auth::user()->id)
            ->paginate(self::$limitItensPagination);

        $key = "task_my_" . Auth::user()->nickname . "_{$currentPage}_route";

        return $this->cached($key, TaskResource::collection($tasks));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(string $id, TaskRequest $request)
    {
        $this->checkId($id);

        $task = Task::findOrFail($id);
        $this->checkUserCreatorId($task);

        $request->validated();
        $request->merge($this->getUserCreatorId($request));

        $task->update($request->only(['title', 'description', 'tip', 'level', 'categories_id', 'user_creator_id']));

        return (new TaskResource($task))->additional([
            'message' => 'Tarefa atualizada com sucesso.'
        ]);
    }

    /**
     * Remove the specified task in storage.
     */
    public function destroy(string $id)
    {
        $this->checkId($id);
        $this->checkTaskUserIntegrity($id);

        $task = Task::findOrFail($id);
        $this->checkUserCreatorId($task);

        $task->delete();

        return ['message' => 'Tarefa deletada com sucesso.'];
    }

    /** 
     * Get the user creator id per user authenticated
     */
    private function getUserCreatorId(TaskRequest $request): array
    {
        return ['user_creator_id' => $request->user()->id];
    }

    /**
     * Check the user create id for the task to be changed.
     * 
     * @throws \App\Exceptions\ForbiddenException
     */
    private function checkUserCreatorId(Task $task)
    {
        if ($task->user_creator_id != Auth::user()->id)
            throw new ForbiddenException("Você não pode alterar uma tarefa que você não criou.");
    }

    /**
     * Check the integrity of the tasks table with the task_user table.
     * 
     * @throws \App\Exceptions\IntegrityException
     */
    private function checkTaskUserIntegrity(int $id)
    {
        if (TaskUser::firstWhere('tasks_id', $id))
            throw new IntegrityException("Não pode alterar um desafio que está associado a um usuário.");
    }
}
