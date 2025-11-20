<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Exceptions\IntegrityException;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Exceptions\ForbiddenException;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        return $this->cached('category_route', CategoryResource::collection(Category::all()));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();
        $request->merge($this->getUserCreatorId($request));

        $category = Category::create($request->only(['name', 'user_creator_id']));

        return (new CategoryResource($category))->additional([
            'message' => 'Categoria cadastrada com sucesso.'
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        $this->checkId($id);

        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->checkId($id);
        $this->checkTaskIntegrity($id);

        $category = Category::findOrFail($id);
        $this->checkUserCreatorId($category);

        $request->validated();
        $request->merge($this->getUserCreatorId($request));

        $category->update($request->only(['name', 'user_creator_id']));

        return (new CategoryResource($category))->additional([
            'message' => 'Categoria atualizada com sucesso.'
        ]);
    }

    /**
     * Remove the specified category in storage.
     */
    public function destroy(string $id)
    {
        $this->checkId($id);
        $this->checkTaskIntegrity($id);

        $category = Category::findOrFail($id);
        $this->checkUserCreatorId($category);
        $category->delete();

        return ['message' => 'Sucesso em excluir a categoria'];
    }

    /**
     * Get the user creator id per user authenticated
    */
    private function getUserCreatorId(CategoryRequest $request): array
    {
        return ['user_creator_id' => $request->user()->id];
    }

    /**
     * Check the user create id for the category to be changed.
     *
     * @throws \App\Exceptions\ForbiddenException
     */
    private function checkUserCreatorId(Category $category)
    {
        if ($category->user_creator_id != Auth::user()->id)
            throw new ForbiddenException("Você não pode alterar uma categoria que você não criou.");
    }

    /**
     * Check the integrity of the categories table with the tasks table.
     *
     * @throws \App\Exceptions\IntegrityException
     */
    private function checkTaskIntegrity(string $id)
    {
        if (Task::firstWhere('categories_id', $id))
            throw new IntegrityException("Não pode alterar uma categoria que está cadastrada num desafio.");
    }
}
