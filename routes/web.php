<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
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


// Landing
Route::get('/', [DashboardController::class, 'landing'])->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'view'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Login
Route::get('/login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'view'])->middleware('auth');
Route::get('/dashboard', [ArticleController::class, 'show'])->middleware('auth');
Route::get('/dashboard', [ArticleController::class, 'search'])->middleware('auth');

// Add Articles
Route::get('/add-article', [ArticleController::class, 'view'])->middleware('auth');
Route::post('/add-article', [ArticleController::class, 'store'])->middleware('auth');

// Article Details
Route::get('/article-details/{id}', [ArticleController::class, 'showDetail'])->middleware('auth');

// My Article
Route::get('/my-article/{id}', [ArticleController::class, 'showArticle'])->middleware('auth');
Route::get('/edit-article/{id}', [ArticleController::class, 'editArticle'])->middleware('auth');
Route::patch('/update-article/{id}', [ArticleController::class, 'updateArticle'])->middleware('auth');
Route::delete('/delete-article/{id}', [ArticleController::class, 'deleteArticle'])->middleware('auth');

// My Profile
Route::get('/my-profile/{id}', [LoginController::class, 'showProfile'])->middleware('auth');
Route::patch('/add-picture/{id}', [RegisterController::class, 'storePicture'])->middleware('auth');
Route::get('/edit-profile/{id}', [LoginController::class, 'editProfile'])->middleware('auth');
Route::patch('/update-profile/{id}', [LoginController::class, 'updateProfile'])->middleware('auth');

// User List
Route::get('/user-lists', [RegisterController::class, 'showUser'])->middleware('isAdmin');
Route::get('/view-profile/{id}', [LoginController::class, 'showProfileAdmin'])->middleware('isAdmin');
Route::delete('/delete-user/{id}', [LoginController::class, 'deleteUser'])->middleware('isAdmin');

