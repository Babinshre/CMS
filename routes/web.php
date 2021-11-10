<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/trashed', [App\Http\Controllers\PostController::class, 'trashed'])->name('trashed-post.index');
    Route::PUT('/restore-post/{post}', [App\Http\Controllers\PostController::class, 'restorePost'])->name('restore-post');
    Route::resource('categories', CategoriesController::class);
    Route::resource('tags', TagsController::class);
    Route::resource('posts', PostController::class); 
});

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('users', [UsersController::class,'index'])->name('users.index');
    Route::get('users/profile', [UsersController::class,'edit'])->name('user.edit-profile');
    Route::put('users/profile', [UsersController::class,'update'])->name('user.update-profile');
    Route::post('users/{user}/make-admin', [UsersController::class,'makeAdmin'])->name('user.make-admin');
});

