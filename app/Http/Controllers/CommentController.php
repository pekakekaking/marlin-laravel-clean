<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Services\Helpers;
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
        $data['user_id'] = auth()->id();
        Comment::create($data);

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

    public function approve(Post $post, Comment $comment, Helpers $helper)
    {
        Gate::authorize('update', $comment);
        $helper->HideOrShowEntityToUsers($comment, 'is_approved');

        return back();
    }
}
