<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('login');
})->name('products.login');

Route::get('/signup', function () {
    return view('signup');
})->name("products.signup");

Route::controller(ProductController::class)->group(function(){
    Route::get('/products/create','create')->name('products.create');
    Route::get('/products','index')->name('products.list');
    Route::post('/products','store')->name('products.store');
    Route::get('/products/{product}/edit','edit')->name('products.edit');
    Route::put('/products/{product}','update')->name('products.update');
    Route::delete('/products/{product}','destroy')->name('products.destroy');
});