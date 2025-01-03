<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::resources([
        'categories'=>CategoryController::class,
        'posts'=> PostController::class,
    ]);
    Route::get('/posts/{post}/category',[PostController::class, 'selectCategory']);
    Route::post('/posts/{post}/category',[PostController::class, 'updateCategory']);
    Route::get('/posts/{post}/status',[PostController::class, 'updateStatus']);
    Route::get('/posts/{post}/image',[PostController::class, 'showImage']);
    Route::post('/posts/{post}/image',[PostController::class, 'updateImage']);
});

Route::get('/', function (){
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
