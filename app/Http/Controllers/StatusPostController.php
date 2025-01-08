<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatusPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, Helpers $helper)
    {
        Gate::authorize('update', $post);
        $helper->HideOrShowEntityToUsers($post, 'is_published');

        return redirect()->route('posts.show', $post);
    }
}
