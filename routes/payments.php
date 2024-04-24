<?php

use App\Http\Controllers\Payments\MonobankController;
use Illuminate\Support\Facades\Route;

Route::name('monobank.')->prefix('monobank')->controller(MonobankController::class)->group(function() {
    Route::get('status/{order:uuid}', 'check')->name('check');
    Route::post('webhook/{order:uuid}', 'webhook')->name('webhook');
});
