<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePictureInPostRequest;
use App\Models\Post;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Gate;

class PictureInPostController extends Controller
{
    public function showImage(Post $post)
    {
        $post = (new ResourceService)->collectOne($post);

        return view('image', compact('post'));
    }

    public function updateImage(UpdatePictureInPostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $data = $request->validated();
        $post->updateImageInPost($data);

        return back();
    }
}
