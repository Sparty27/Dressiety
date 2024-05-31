<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Livewire\Admin\Categories\Categories;
use App\Livewire\Admin\Categories\CategoryForm;
use App\Livewire\Admin\Categories\CreateCategory;
use App\Livewire\Admin\Categories\EditCategory;
use App\Livewire\Admin\Categories\ShowCategory;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\Orders\Orders;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\EditProduct;
use App\Livewire\Admin\Products\ProductForm;
use App\Livewire\Admin\Products\Products;
use App\Livewire\Admin\Products\SeoProduct;
use App\Livewire\Admin\Products\ShowProduct;
use App\Livewire\Admin\SeoPage;
use App\Livewire\Admin\Tags\CreateTag;
use App\Livewire\Admin\Tags\EditTag;
use App\Livewire\Admin\Tags\ShowTag;
use App\Livewire\Admin\Tags\TagForm;
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

Route::prefix('/categories')->name('categories.')->group(function() {
    Route::get('/', Categories::class)->name('index');
    Route::get('/create', CategoryForm::class)->name('create');
//    Route::get('/{category}', ShowCategory::class)->name('show');
    Route::get('/{category}/edit', CategoryForm::class)->name('edit');
});

Route::prefix('/products')->name('products.')->group(function() {
    Route::get('/', Products::class)->name('index');
    Route::get('/create', ProductForm::class)->name('create');
    Route::get('/{product}', ShowProduct::class)->name('show');
    Route::get('/{product}/edit', ProductForm::class)->name('edit');
    Route::get('/{product}/seo', SeoProduct::class)->name('seo');
});

Route::prefix('/tags')->name('tags.')->group(function() {
    Route::get('/', Tags::class)->name('index');
    Route::get('/create', TagForm::class)->name('create');
//    Route::get('/{tag}', ShowTag::class)->name('show');
    Route::get('/{tag}/edit', TagForm::class)->name('edit');
});


Route::prefix('/orders')->name('orders.')->group(function() {
    Route::get('/', Orders::class)->name('index');
});

Route::get('/seo', SeoPage::class)->name('seo.index');

