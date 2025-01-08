<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryInPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PictureInPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusPostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
    ]);
    Route::get('/posts/{post}/category', [CategoryInPostController::class, 'selectCategory']);
    Route::post('/posts/{post}/category', [CategoryInPostController::class, 'updateCategory']);
    Route::get('/posts/{post}/status', StatusPostController::class);
    Route::get('/posts/{post}/image', [PictureInPostController::class, 'showImage']);
    Route::post('/posts/{post}/image', [PictureInPostController::class, 'updateImage']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'approve']);
    Route::get('/comments/{comment}', [CommentController::class, 'destroy']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
