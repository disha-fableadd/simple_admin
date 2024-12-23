<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');


Route::get('/categories', [CategoryController::class, 'display'])->name('categories.display');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); 
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); 
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); 

Route::get('/products', [ProductController::class, 'display'])->name('products.display');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{pid}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


