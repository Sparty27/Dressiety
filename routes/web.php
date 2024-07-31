<?php

use App\Http\Middleware\BasketEmpty;
use App\Livewire\Home;
use App\Livewire\MakeOrder;
use App\Livewire\Shop;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
]);

Route::get('/', Shop::class)->name('index');

Route::get('/shop', Shop::class)->name('shop');

Route::get('/order/make', MakeOrder::class)->name('order.make')->middleware(BasketEmpty::class);

Route::prefix('/products')->name('products.')->group(function() {
    Route::get('/{product}', ShowProduct::class)->name('show');
});

Route::get('/test', [TestController::class, 'index'])->name('test.index');
