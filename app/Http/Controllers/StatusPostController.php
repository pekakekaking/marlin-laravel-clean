<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\HideOrShowEntityToUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatusPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        Gate::authorize('update', $post);
        HideOrShowEntityToUsers::HideOrShow($post, 'is_published');

        return redirect()->route('posts.show', $post);
    }
}
