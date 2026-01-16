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

Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');

Route::get('/', Home::class)->name('home');

Route::get('/iluminacion/catalogo', Catalog::class)->name('ilumination.catalog');

Route::get('/iluminacion', Ilumination::class)->name('ilumination');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contacto', Contact::class)->name('contact');

Route::get('/iluminacion/catalogo/producto/{id}', ShowProduct::class)->name('product.show');

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
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/blog'));

    // Agrega cada post publicado
    Post::where('status', 'published')->each(function ($post) use ($sitemap) {
        $sitemap->add(
            Url::create(route('blog.show', $post->slug))
                ->setLastModificationDate($post->updated_at)
        );
    });

    return $sitemap->toResponse(request());
});
