<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Livewire\Admin\Categories\Categories;
use App\Livewire\Admin\Categories\CreateCategory;
use App\Livewire\Admin\Categories\EditCategory;
use App\Livewire\Admin\Categories\InfoCategory;
use App\Livewire\Admin\Categories\ShowCategory;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\Orders\Orders;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\EditProduct;
use App\Livewire\Admin\Products\Products;
use App\Livewire\Admin\Products\ShowProduct;
use App\Livewire\Admin\Tags\CreateTag;
use App\Livewire\Admin\Tags\EditTag;
use App\Livewire\Admin\Tags\ShowTag;
use App\Livewire\Admin\Tags\Tags;
use Illuminate\Support\Facades\Route;

//Route::prefix('/categories')->controller(CategoryController::class)->name('categories.')->group(function () {
//    Route::get('/', 'index')->name('index');
//    Route::get('/create', 'create')->name('create');
//    Route::get('/{category}', 'show')->name('show');
//    Route::post('/', 'store')->name('store');
//    Route::get('/{category}/edit', 'edit')->name('edit');
//    Route::post('/{category}', 'update')->name('update');
//    Route::delete('/{category}', 'destroy')->name('destroy');
//});

//Route::resource('products', ProductController::class);
//Route::resource('tags', TagController::class);

Route::get('/', Home::class)->name('home');

Route::get('/categories', Categories::class)->name('categories.index');
Route::get('/categories/create', CreateCategory::class)->name('categories.create');
Route::get('/categories/{category}', ShowCategory::class)->name('categories.show');
Route::get('/categories/{category}/edit', EditCategory::class)->name('categories.edit');

Route::get('/products', Products::class)->name('products.index');
Route::get('/products/create', CreateProduct::class)->name('products.create');
Route::get('/products/{product}', ShowProduct::class)->name('products.show');
Route::get('/products/{product}/edit', EditProduct::class)->name('products.edit');

Route::get('/tags', Tags::class)->name('tags.index');
Route::get('/tags/create', CreateTag::class)->name('tags.create');
Route::get('/tags/{tag}', ShowTag::class)->name('tags.show');
Route::get('/tags/{tag}/edit', EditTag::class)->name('tags.edit');

Route::get('/orders', Orders::class)->name('orders.index');
