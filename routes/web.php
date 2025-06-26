<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog;
use App\Livewire\Home;
use App\Livewire\ShowProduct;
use App\Livewire\Contact;

Route::get('/', Home::class)->name('home');

Route::get('/catalog', Catalog::class)->name('catalog');

Route::get('/contact', Contact::class)->name('contact');

Route::get('/product/{id}', ShowProduct::class)->name('product.show');