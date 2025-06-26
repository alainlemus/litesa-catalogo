<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog;
use App\Livewire\Home;
use App\Livewire\ShowProduct;
use App\Livewire\Contact;
use App\Livewire\Blog;

Route::get('/', Home::class)->name('home');

Route::get('/catalog', Catalog::class)->name('catalog');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contact', Contact::class)->name('contact');

Route::get('/product/{id}', ShowProduct::class)->name('product.show');