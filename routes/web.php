<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubcategoryController;
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
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/name/update', [HomeController::class, 'name_update']);
Route::post('/pass/update', [HomeController::class, 'pass_update']);
Route::post('/photo/update', [HomeController::class, 'photo_update']);

// Delete
Route::get('/user/delte/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');

// Category
Route::get('/category', [CategoryController::class, 'index'])->name('add.category');
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::get('/category/soft_delete/{category_id}', [CategoryController::class, 'soft_delete'])->name('category.soft_delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/', [CategoryController::class, 'update']);
Route::get('/category/restore/{category_id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('/category/hard_delete/{category_id}', [CategoryController::class, 'hard_delete'])->name('category.hard_delete');
Route::post('/mark/delete', [CategoryController::class, 'mark_delete']);

// Sub Category
Route::get('/add.subcategory', [SubcategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::post('/add.subcategory/insert', [SubcategoryController::class, 'insert']);
Route::get('/add.subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'edit'])->name('edit.subcategory');
