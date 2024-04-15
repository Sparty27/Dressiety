<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('/categories')->controller(CategoryController::class)->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{category}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::post('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');
});

Route::resource('products', ProductController::class);
Route::resource('tags', TagController::class);

Route::get('/', function (){
    dd('you are admin');
});
