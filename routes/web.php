<?php

use App\Http\Controllers\CategoryController;
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

Route::prefix('/categories')->controller(CategoryController::class)->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{category}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::post('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');
});