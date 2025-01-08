<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryInPostRequest;
use App\Models\Post;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Gate;

class CategoryInPostController extends Controller
{
    public function selectCategory(Post $post)
    {
        Gate::authorize('update', $post);
        $post = (new ResourceService)->collectOne($post, 'category');
        $categories = (new ResourceService)->collectAll('Category');

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
