<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [FrontEndController::class, 'welcome']);
Route::get('/about', [FrontEndController::class, 'about']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Users
Route::get('/users', [HomeController::class, 'users'])->name('users');

// Delete
Route::get('/user/delte/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');

// Category
Route::get('/category', [CategoryController::class, 'index'])->name('add.category');
