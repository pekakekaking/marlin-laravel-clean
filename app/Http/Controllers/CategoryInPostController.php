<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryInPostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class CategoryInPostController extends Controller
{
    public function selectCategory(Post $post)
    {
        Gate::authorize('update', $post);
        $post = PostResource::make($post->load('category'))->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();

        return view('select_category', compact('post', 'categories'));
    }

    public function updateCategory(UpdateCategoryInPostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $data = $request->validated();
        $post->update($data);

        return back();
    }
}
