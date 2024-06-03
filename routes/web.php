<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
//user dan follow
Route::get('user',[AuthController::class, 'user'])->name('user');
Route::post('/follow/{userId}', [AuthController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{userId}', [AuthController::class, 'unfollow'])->name('unfollow');



//dashboard routes
Route::get('/dashboard', [AuthController::class, 'index'])->name('home');

//login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/logout', [AuthController::class, 'showLogoutForm'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//user
Route::get('/explore',[UserController::class,'explore'])->name('explore');
Route::get('/posting',[UserController::class,'post'])->name('posting');

//post
Route::post('/post',[PostController::class,'post'])->name('post.store');
Route::get('/home',[PostController::class,'index'])->name('home');

// comment
Route::get('/comments/{post}',[CommentsController::class,'comment'])->name('comments');
Route::post('/posts/{post}/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::post('/comments/{comment}/reply', [CommentsController::class, 'reply'])->name('comments.reply');
Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');

//comment, like, bookmark
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
Route::post('/posts/{post}/bookmark', [PostController::class, 'bookmark'])->name('posts.bookmark');

//profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/edit-profile', [UserController::class, 'editprofile'])->name('edit-profile');
Route::put('/edit-profile', [UserController::class, 'updateProfile'])->name('update-profile');







