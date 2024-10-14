<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');

// MARK : Products
Route::prefix('products')->group(function () {
    Route::get('', \App\Livewire\Product\Index::class)->name('products.index');
    Route::get('create', \App\Livewire\Product\Create::class)->name('products.create');
    Route::get('{product}/edit', \App\Livewire\Product\Edit::class)->name('products.edit');
});

// MARK : Users
Route::prefix('users')->group(function () {
    Route::get('', \App\Livewire\User\Index::class)->name('users.index');
});
