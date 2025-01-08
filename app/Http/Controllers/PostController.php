<?php

namespace App\Http\Controllers;

use App\Events\PostShowEvent;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\ResourceService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = PostResource::collection(Post::all()->load('category'))->resolve();

        return view('main', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Gate::authorize('create', Post::class);
        $data = $request->validated();
        Post::createWithUserAndCategory($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        PostShowEvent::dispatch($post);
        $post = (new ResourceService)->collectOne($post, 'category');
        $threadedComments = collect(Comment::where('post_id', '=', $post['id'])->get()->where('parent_id', null)->load('children'));

        return view('show', compact('post', 'threadedComments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        $post = (new ResourceService)->collectOne($post);

        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $data = $request->validated();
        $post->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return Response::HTTP_NO_CONTENT;
    }
}
