<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

// Admin Logout
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// Admin Category All Routes
Route::get('/categories', [CategoryController::class, 'Index'])->name('categories');

Route::get('/add/category', [CategoryController::class, 'AddCategory'])->name('add.category');

Route::post('/store/category', [CategoryController::class, 'StoreCategory'])->name('store.category');

Route::get('/edit/category/{id}', [CategoryController::class, 'EditCategory'])->name('edit.category');

Route::post('/update/category/{id}', [CategoryController::class, 'UpdateCategory'])->name('update.category');

Route::get('/delete/category/{id}', [CategoryController::class, 'DeleteCategory'])->name('delete.category');
