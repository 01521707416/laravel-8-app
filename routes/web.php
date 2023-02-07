<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
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

// FrontEnd
Route::get('/', [FrontEndController::class, 'index'])->name('homepage');
Route::get('/about', [FrontEndController::class, 'about']);
Route::get('/product/details/', [FrontEndController::class, 'product_details'])->name('product.details');

Auth::routes();

// Home
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
Route::post('/mark/restore', [CategoryController::class, 'mark_restore']);

// Sub Category
Route::get('/add.subcategory', [SubcategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::post('/add.subcategory/insert', [SubcategoryController::class, 'insert']);
Route::get('/add.subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'edit'])->name('edit.subcategory');
Route::post('/add.subcategory/update', [SubcategoryController::class, 'update']);
Route::get('/add.subcategory/soft_delete/{subcategory_id}', [SubcategoryController::class, 'soft_delete'])->name('subcategory.soft_delete');
Route::get('/add.subcategory/restore/{subcategory_id}', [SubcategoryController::class, 'restore'])->name('subcategory.restore');
Route::get('/add.subcategory/hard_delete/{subcategory_id}', [SubcategoryController::class, 'hard_delete'])->name('subcategory.hard_delete');
Route::post('/add.subcategory/mark_delete', [SubcategoryController::class, 'mark_delete'])->name('mark_del_sub');

// Product
Route::get('/add/product', [ProductController::class, 'index'])->name('add.product');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/product/list', [ProductController::class, 'view'])->name('product.list');
Route::get('/product/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');

// Inventories
Route::get('/add/color/size', [InventoryController::class, 'color'])->name('add.color.size');
Route::post('/insert/color', [InventoryController::class, 'insert_color']);
Route::get('/color/edit/{color_id}', [InventoryController::class, 'edit_color'])->name('edit.color');
Route::post('/color/update', [InventoryController::class, 'update_color']);
Route::post('/insert/size', [InventoryController::class, 'insert_size']);
Route::get('/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/insert', [InventoryController::class, 'inventory_insert']);
