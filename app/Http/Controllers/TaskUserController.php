<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use App\Models\UserRelationships;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ForbiddenException;
use App\Exceptions\IntegrityException;
use App\Http\Requests\TaskUserRequest;
use App\Http\Resources\TaskUserResource;
use App\Http\Requests\TaskUserUpdateRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TaskUserController extends Controller
{
    private static int $limitItensPagination = 500;

    /**
     * Display a listing of the tasks for the currently assigned user or recipient.
     */
    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user->hasRole('responsible'))
            $taskUsers = TaskUser::with('task')->with('userReceiver')->where('user_assigner_id', $user->id)
                ->paginate(self::$limitItensPagination);

        if($user->hasRole('child'))
            $taskUsers = TaskUser::with('task')->where('user_receiver_id', $user->id)
                ->paginate(self::$limitItensPagination);

        $currentPage = $request->get('page');

        $key = "taskuser_{$user->nickname}_{$currentPage}_route";

        return $this->cached($key, TaskUserResource::collection($taskUsers));
    }

    /**
     * Store a newly created assignment task for your children.
     */
    public function store(TaskUserRequest $request)
    {
        $this->isUserOwnerOfTask($request->tasks_id);
        $this->isTaskNotAssigned($request->tasks_id, $request->user_receiver_id);
        $this->checkUserIsRelated($request->user_receiver_id);

        $taskUser = TaskUser::create([
            'user_assigner_id' => Auth::user()->id,
            'user_receiver_id' => $request->user_receiver_id,
            'tasks_id'         => $request->tasks_id
        ]);

        return (new TaskUserResource($taskUser))->additional([
            'message' => 'Tarefa atribuida com sucesso.'
        ]);
    }

    /**
     * Display the specified task that the user is linked to by id.
     */
    public function show(string $id)
    {
        $this->checkId($id);
        $user = User::findOrFail(Auth::user()->id);

        if($user->hasRole('child'))
            $taskUser = TaskUser::with('task')->where('user_receiver_id', Auth::user()->id)
            ->where('task_user.id', $id)
            ->firstOrFail();

        if($user->hasRole('responsible'))
            $taskUser = TaskUser::with('task')->with('userReceiver')->where('user_assigner_id', Auth::user()->id)
            ->where('task_user.id', $id)
            ->firstOrFail();

        return new TaskUserResource($taskUser);
    }

    /**
     * Returns the finished tasks.
     */
    public function finished(bool $done)
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user->hasRole('responsible'))
            $taskUsers = TaskUser::with('task')->with('userReceiver')->where('user_assigner_id', $user->id)
                ->where('done', $done)
                ->paginate(self::$limitItensPagination);

        if($user->hasRole('child'))
            $taskUsers = TaskUser::with('task')->where('user_receiver_id', $user->id)
                ->where('done', $done)
                ->paginate(self::$limitItensPagination);

        return TaskUserResource::collection($taskUsers);
    }

    /**
     * Search for tasks linked by title or content.
     */
    public function search(string $value)
    {
        $user = User::findOrFail(Auth::user()->id);

        if($user->hasRole('child'))
            $taskUsers = TaskUser::where('user_receiver_id', Auth::user()->id)
                ->whereHas('task', function ($query) use ($value) {
                    $query->where('title', 'like', "%$value%")
                        ->orWhere('description', 'like', "%$value%");
                })
                ->with('task')
                ->paginate(self::$limitItensPagination);

        if($user->hasRole('responsible'))
            $taskUsers = TaskUser::where('user_assigner_id', Auth::user()->id)
                ->whereHas('task', function ($query) use ($value) {
                    $query->where('title', 'like', "%$value%")
                        ->orWhere('description', 'like', "%$value%");
                })
                ->with('task')->with('userReceiver')
                ->paginate(self::$limitItensPagination);

        return TaskUserResource::collection($taskUsers);
    }

    /**
     * Returns the daily challenge for the child user.
     */
    public function taskDay()
    {
        $taskUser = TaskUser::where('user_receiver_id', Auth::user()->id)
            ->where('done', false)
            ->orderBy('created_at', 'desc')->first();

        return new TaskUserResource($taskUser);
    }

    /**
     * Update the specified taskuser in storage.
     */
    public function update(string $id, TaskUserUpdateRequest $request)
    {
        $this->checkId($id);

        $request->merge([
            'difficult_level' => $request->has('difficult_level') ? $request->difficult_level : null,
            'finished_at'     => $request->done ? now() : null,
        ]);

        $taskUser = TaskUser::where('id', $id)->where('user_receiver_id', Auth::user()->id)->firstOrFail();
        $taskUser->update($request->only(['finished_at', 'done', 'difficult_level']));

        return (new TaskUserResource($taskUser))->additional([
            'message' => 'Status da tarefa atualizado com sucesso.'
        ]);
    }

    /**
     * Remove the specified taskuser in storage.
     */
    public function destroy(string $id)
    {
        $this->checkId($id);

        $taskUser = TaskUser::find($id)->where('user_assigner_id', Auth::user()->id)->firstOrFail();
        $taskUser->delete();

        return ['message' => 'Atribuição de tarefa deletada com sucesso.'];
    }

    /**
     * Check if the user relationship already exists.
     *
     * @throws \App\Exceptions\ForbiddenException
     * @throws \App\Exceptions\BadRequestHttpException
     */
    protected function checkUserIsRelated(string|int $userId): void
    {
        $this->checkId($userId);
        $user = User::findOrFail($userId);

        if (!$user->hasRole('child'))
            throw new ForbiddenException("Esse usuário é responsável");

        $existingRelationship = UserRelationships::where('user_related_id', $user->id)
            ->where('user_id', Auth::user()->id)->get();

        if($existingRelationship->isEmpty())
            throw new BadRequestHttpException("Relacionamento de usuário não existe.");
    }

    /**
     * Check whether the task has already been linked to that user.
     *
     * @throws \App\Exceptions\IntegrityException
     */
    private function isTaskNotAssigned(string|int $taskId, string|int $userReceiverId): void
    {
        $existingAssignment = TaskUser::where('tasks_id', $taskId)
            ->where('user_receiver_id', $userReceiverId)
            ->first();

        if ($existingAssignment)
            throw new IntegrityException("Tarefa já atrelada") ;
    }

    /**
     * Check whether the user is the owner of that task.
     *
     * @throws \App\Exceptions\IntegrityException
     */
    private function isUserOwnerOfTask(string|int $taskId): void
    {
        $task = Task::findOrFail($taskId);

        $verify = $task->user_creator_id == Auth::user()->id || $task->user_creator_id == 1; // id do admin

        if(!$verify)
            throw new IntegrityException("Essa tarefa é de outro usuário") ;
    }
}

