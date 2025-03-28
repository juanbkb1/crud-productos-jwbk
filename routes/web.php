<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class)->except(['show']);
Route::get('products/data', [ProductController::class, 'data'])->name('products.data');