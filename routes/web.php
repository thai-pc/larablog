<?php

use App\Http\Controllers\Blog\FrontController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Auth Routes
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

require_once ('admin.php');

Route::get('/', [FrontController::class, 'allPost']);
Route::get('/{post:slug}', [FrontController::class, 'singlePost'])
    ->name('single-post');

//Comment Routes
Route::post('{post}/commnet/strore', [CommentController::class, 'store'])
    ->name('comment.store');


//Categories Routes
Route::get('/category/{category:slug}', [FrontController::class, 'categoryWisePost'])
    ->name('category-post');

//Tags Routes
Route::get('/tag/{tag:slug}', [FrontController::class, 'tagWisePosts'])
    ->name('tag-post');

//Author Routes
Route::get('/author/{user:slug}', [FrontController::class, 'authorWisePosts'])
    ->name('author-post');
