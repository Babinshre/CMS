<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
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
    Route::resource('posts', PostController::class); 
});


