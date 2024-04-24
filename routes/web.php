<?php

use App\Livewire\MakeOrder;
use App\Livewire\Shop;
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

Auth::routes();

Route::get('/test', [TestController::class, 'index'])->name('test.index');

Route::get('/shop', Shop::class);

Route::get('/order/make', MakeOrder::class)->name('order.make');
