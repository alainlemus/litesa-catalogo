<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog;
use App\Livewire\Home;
use App\Livewire\ShowProduct;
use App\Livewire\Contact;
use App\Livewire\Blog;
use App\Livewire\Blog\ShowPost;
use App\Livewire\Ilumination;
use App\Livewire\NewsletterForm;
use App\Livewire\PrivacyPolicyPage;
use Illuminate\Support\Facades\Mail;

Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');

Route::get('/', Home::class)->name('home');

Route::get('/iluminacion/catalogo', Catalog::class)->name('ilumination.catalog');

Route::get('/iluminacion', Ilumination::class)->name('ilumination');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contacto', Contact::class)->name('contact');

Route::get('/producto/{id}', ShowProduct::class)->name('product.show');

Route::get('/aviso-de-privacidad', PrivacyPolicyPage::class)->name('privacy.policy');

Route::get('/test-mail', function () {
    Mail::to('alainttlm@gmail.com')->send(new \App\Mail\ContactNotification(
        'Prueba', 'correo@dominio.com', 'Mensaje de prueba de aplicacion'
    ));

    return 'Correo enviado (o intentado)';
});

Route::get('/newsletter/unsubscribe/{token}', [NewsletterForm::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');
