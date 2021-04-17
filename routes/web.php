<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

// HOME
Route::get('/', function () {
    return view('home');
})->name('home'); /* We will use a closure for Home so that we don't have to create a controller for something simple*/

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); /* In order to ensure that someone who is not logged in can see a dashboard you must use the Auth middelware by adding ->middleware('auth') in the routes. You can also add the middleware directly in the controller with __constructor if it should apply to all routes */

//POSTS
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//LIKES
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('post.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('post.likes');

//USER PROFILE
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');


//INDEX
//We can get rid of this since we know that we want to render home as the index page
// Route::get('/', function () {
//     return view('home');
// });
