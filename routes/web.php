<?php

use App\Livewire\Counter;
use App\Livewire\MakeOrder;
use App\Livewire\Shop;
use App\Models\Product;
use App\Models\BasketProduct;
use App\Services\MonobankService\MonobankService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Services\BasketService\BasketService;

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

Route::resource('products', ProductController::class);
Route::resource('tags', TagController::class);

Route::get('/test', function(BasketService $service)
{
})->name('test.index');

Auth::routes();

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/counter', Counter::class);

Route::get('/shop', Shop::class);

Route::get('/order/make', MakeOrder::class)->name('order.make');
