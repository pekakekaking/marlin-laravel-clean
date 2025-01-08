<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Services\Helper;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Support\Facades\Gate;

#[ObservedBy([CommentObserver::class])]
class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        Comment::createWithUser($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();

        return back();
    }

    public function approve(Post $post, Comment $comment, Helper $helper)
    {
        Gate::authorize('update', $comment);
        $helper->HideOrShowEntityToUsers($comment, 'is_approved');

        return back();
    }
}
