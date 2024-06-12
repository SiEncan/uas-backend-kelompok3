<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DiscussionsController::class, 'home'])->middleware('auth');
Route::get('/discussion/{id}', [DiscussionsController::class, 'viewDiscussion'])->middleware('auth');

Route::get('/community', [CommunityController::class, 'home'])->middleware('auth');
Route::get('/community/{id}', [CommunityController::class, 'viewCommunity'])->middleware('auth');
Route::post('/community', [CommunityController::class, 'createCommunity']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/myprofile', [ProfileController::class, 'myProfileView'])->middleware('auth');
Route::patch('/update-public-info', [ProfileController::class, 'updateInfo'])->middleware('auth');