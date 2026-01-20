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
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;

Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');

Route::get('/', Home::class)->name('home');

Route::get('/iluminacion/catalogo', Catalog::class)->name('ilumination.catalog');

Route::get('/iluminacion', Ilumination::class)->name('ilumination');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contacto', Contact::class)->name('contact');

Route::get('/iluminacion/catalogo/producto/{slug}', ShowProduct::class)->name('product.show');

Route::get('/aviso-de-privacidad', PrivacyPolicyPage::class)->name('privacy.policy');

Route::get('/test-mail', function () {
    Mail::to('alainttlm@gmail.com')->send(new \App\Mail\ContactNotification(
        'Prueba', 'correo@dominio.com', 'Mensaje de prueba de aplicacion'
    ));

    return 'Correo enviado (o intentado)';
});

Route::get('/newsletter/unsubscribe/{token}', [NewsletterForm::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // Página principal
    $sitemap->add(Url::create(url('/')));
    // Catálogo
    $sitemap->add(Url::create(url('/iluminacion/catalogo')));
    // Contacto
    $sitemap->add(Url::create(url('/contacto')));
    // Aviso de privacidad
    $sitemap->add(Url::create(url('/aviso-de-privacidad')));
    // Iluminación
    $sitemap->add(Url::create(url('/iluminacion')));
    // Blog
    $sitemap->add(Url::create(url('/blog')));

    // Productos
    foreach (Product::whereNotNull('slug')->get() as $product) {
        $sitemap->add(Url::create(url('/iluminacion/catalogo/producto/' . $product->slug)));
    }
    // Posts
    foreach (Post::where('status', 'published')->whereNotNull('slug')->get() as $post) {
        $sitemap->add(Url::create(url('/blog/' . $post->slug)));
    }

    return $sitemap->toResponse(request());
});
