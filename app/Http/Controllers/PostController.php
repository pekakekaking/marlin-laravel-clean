<?php

namespace App\Http\Controllers;

use App\Events\PostShowEvent;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateCategoryInPostRequest;
use App\Http\Requests\UpdatePictureInPostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\ChangeBoolService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Services\CollectCommentService;

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
        $data['user_id'] = auth()->user()->id;
        $data['category_id'] = Category::all()->first()->id;
        Post::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        PostShowEvent::dispatch($post);
        $post = PostResource::make($post->load(['category','comments.user']))->resolve();
        $threadedComments=CollectCommentService::threaded($post['comments']);
        return view('show', compact('post','threadedComments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        $post = PostResource::make($post->load('category'))->resolve();
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
        return PostResource::make($post)->resolve();
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
    public function updateStatus(Post $post)
    {
        Gate::authorize('update', $post);
        ChangeBoolService::changeBool($post,'is_published');
        return redirect()->route('posts.show', $post);
    }
    public function showImage(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return view('image', compact('post'));
    }
    public function updateImage(UpdatePictureInPostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $data = $request->validated();
        $data['image']=Storage::disk('public')->put('images',$data['image']);
        $post->update($data);
        session()->flash('status', 'Image updated successfully');
        return back();
    }
}
