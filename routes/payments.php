<?php

use App\Http\Controllers\Payments\FondyController;
use App\Http\Controllers\Payments\MonobankController;
use Illuminate\Support\Facades\Route;

Route::name('monobank.')->prefix('monobank')->controller(MonobankController::class)->group(function() {
    Route::get('status/{order:uuid}', 'check')->name('check');
    Route::post('webhook/{order:uuid}', 'webhook')->name('webhook');
});

Route::name('fondy.')->prefix('fondy')->controller(FondyController::class)->group(function() {
    Route::post('status/{order:uuid}', 'check')->name('check');
    Route::post('webhook/{order:uuid}', 'webhook')->name('webhook');
});
