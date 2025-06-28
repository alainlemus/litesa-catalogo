<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog;
use App\Livewire\Home;
use App\Livewire\ShowProduct;
use App\Livewire\Contact;
use App\Livewire\Blog;
use App\Livewire\Blog\ShowPost;
use App\Livewire\PrivacyPolicyPage;
use Illuminate\Support\Facades\Mail;

Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');

Route::get('/', Home::class)->name('home');

Route::get('/catalog', Catalog::class)->name('catalog');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contact', Contact::class)->name('contact');

Route::get('/product/{id}', ShowProduct::class)->name('product.show');

Route::get('/aviso-de-privacidad', PrivacyPolicyPage::class)->name('privacy.policy');

Route::get('/test-mail', function () {
    Mail::to('alainttlm@gmail.com')->send(new \App\Mail\ContactNotification(
        'Prueba', 'correo@dominio.com', 'Mensaje de prueba de aplicacion'
    ));

    return 'Correo enviado (o intentado)';
});