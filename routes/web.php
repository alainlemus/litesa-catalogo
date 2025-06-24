<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog;
use App\Livewire\ShowProduct;

Route::get('/', Catalog::class)->name('catalog');

Route::get('/product/{id}', ShowProduct::class)->name('product.show');