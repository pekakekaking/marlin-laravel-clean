<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view', Category::class);
        $categories = CategoryResource::collection(Category::all()->load('posts'))->resolve();
        return view('category_list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Category::class);
        return view('category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('create', Category::class);
        $data = $request->validated();
        $category = Category::create($data);
        return CategoryResource::make($category)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('edit', $category);
        $category = CategoryResource::make($category)->resolve();
        return view('category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('edit', $category);
        $data = $request->validated();
        $category->update($data);

        return CategoryResource::make($category)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $category->delete();
        return Response::HTTP_NO_CONTENT;
    }
}
