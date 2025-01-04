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
use Illuminate\Http\Response;
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
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = isset(auth()->user()->id) ? auth()->user()->id : User::all()->first()->id;
        $data['category_id'] = Category::all()->first()->id;
        $post = Post::create($data);
        return PostResource::make($post)->resolve();
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

        $post = PostResource::make($post->load('category'))->resolve();
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        return PostResource::make($post)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return Response::HTTP_NO_CONTENT;
    }

    public function selectCategory(Post $post)
    {
        $post = PostResource::make($post->load('category'))->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();
        return view('select_category', compact('post', 'categories'));
    }

    public function updateCategory(UpdateCategoryInPostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update([
            'category_id' => $data['category']
        ]);
        return PostResource::make($post)->resolve();
    }
    public function updateStatus(Post $post)
    {
        if ($post['is_published'] == '1') {
            $post->update([
                'is_published' => 0
            ]);
        } else {
            $post->update([
                'is_published' => 1
            ]);
        }
        return redirect()->route('posts.show', $post);
    }
    public function showImage(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return view('image', compact('post'));
    }
    public function updateImage(UpdatePictureInPostRequest $request, Post $post)
    {
        $data = $request->validationData();
        $data['image']=Storage::disk('public')->put('images',$data['image']);
        $post->update($data);
        return back();
    }
}
