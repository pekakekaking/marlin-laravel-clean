<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Helper;
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
        (new Helper)->HideOrShowEntityToUsers($post, 'is_published');

        return redirect()->route('posts.show', $post);
    }
}
