<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;

Route::get('/', [DiscussionsController::class, 'home'])->middleware('auth');
Route::get('/discussion/{id}', [DiscussionsController::class, 'viewDiscussion'])->middleware('auth');
Route::post('/discussion', [DiscussionsController::class, 'createDiscussion'])->middleware('auth');
Route::delete('/discussion/{id}', [DiscussionsController::class, 'deleteDiscussion'])->middleware('auth');
Route::post('/discussion/post-comment', [CommentsController::class, 'create'])->middleware('auth');
Route::delete('/comment/{id}', [CommentsController::class, 'deleteComment'])->middleware('auth');
Route::get('/search-discussion', [DiscussionsController::class, 'searchDiscussion'])->middleware('auth');

Route::get('/community', [CommunityController::class, 'home'])->middleware('auth');
Route::get('/community/{id}', [CommunityController::class, 'viewCommunity'])->middleware('auth');
Route::post('/community', [CommunityController::class, 'createCommunity']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/myprofile', [ProfileController::class, 'myProfileView'])->middleware('auth');
Route::get('/profile/{id}', [ProfileController::class, 'profileView'])->middleware('auth');
Route::delete('/profile/{id}', [ProfileController::class, 'deleteProfile'])->middleware('auth');
Route::patch('/update-public-info', [ProfileController::class, 'updateInfo'])->middleware('auth');
Route::patch('/update-private-info', [ProfileController::class, 'updatePassword'])->middleware('auth');