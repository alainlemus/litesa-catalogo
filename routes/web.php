<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Applications;
use App\Livewire\ApplicationShow;
use App\Livewire\Catalog;
use App\Livewire\Faq;
use App\Livewire\Services;
use App\Livewire\Home;
use App\Livewire\ShowProduct;
use App\Livewire\Contact;
use App\Livewire\Blog;
use App\Livewire\Blog\ShowPost;
use App\Livewire\Ilumination;
use App\Livewire\NewsletterForm;
use App\Livewire\PrivacyPolicyPage;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;
use App\Models\ProductUse;
use App\Support\Media;

Route::get('/blog/{slug}', ShowPost::class)->name('blog.show');

Route::get('/', Home::class)->name('home');

Route::get('/nosotros', About::class)->name('about');

Route::get('/servicios', Services::class)->name('services');

Route::get('/preguntas-frecuentes', Faq::class)->name('faq');

Route::get('/iluminacion/aplicaciones', Applications::class)->name('ilumination.applications');

Route::get('/iluminacion/aplicaciones/{slug}', ApplicationShow::class)->name('ilumination.application');

Route::get('/iluminacion/catalogo', Catalog::class)->name('ilumination.catalog');

Route::get('/iluminacion', Ilumination::class)->name('ilumination');

Route::get('/blog', Blog::class)->name('blog');

Route::get('/contacto', Contact::class)->name('contact');

Route::get('/iluminacion/catalogo/producto/{slug}', ShowProduct::class)->name('product.show');

Route::get('/aviso-de-privacidad', PrivacyPolicyPage::class)->name('privacy.policy');

Route::get('/newsletter/unsubscribe/{token}', [NewsletterForm::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /admin',
        'Disallow: /livewire/',
        'Disallow: /newsletter/',
        'Disallow: /*?search=',
        'Disallow: /*?selectedUse=',
        'Disallow: /*?selectedCategory=',
        'Allow: /',
        '',
        'Sitemap: ' . url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});

Route::get('/sitemap.xml', function () {
    $xml = Cache::remember('sitemap.xml', now()->addHour(), function () {
        $sitemap = Sitemap::create();

        $pages = [
            [url('/'), 1.0, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/nosotros'), 0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/servicios'), 0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/preguntas-frecuentes'), 0.5, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/iluminacion'), 0.9, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/iluminacion/aplicaciones'), 0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            [url('/iluminacion/catalogo'), 0.9, Url::CHANGE_FREQUENCY_WEEKLY],
            [url('/blog'), 0.7, Url::CHANGE_FREQUENCY_WEEKLY],
            [url('/contacto'), 0.6, Url::CHANGE_FREQUENCY_YEARLY],
            [url('/aviso-de-privacidad'), 0.2, Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($pages as [$loc, $priority, $frequency]) {
            $sitemap->add(Url::create($loc)->setPriority($priority)->setChangeFrequency($frequency));
        }

        ProductUse::all()->each(fn (ProductUse $use) => $sitemap->add(
            Url::create(url('/iluminacion/aplicaciones/' . $use->slug))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        ));

        Product::with('photos')->whereNotNull('slug')->get()->each(function (Product $product) use ($sitemap) {
            $url = Url::create(url('/iluminacion/catalogo/producto/' . $product->slug))
                ->setLastModificationDate($product->updated_at ?? now())
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

            if ($photo = $product->photos->first()) {
                $url->addImage(Media::url($photo->path), $product->name);
            }

            $sitemap->add($url);
        });

        Post::where('status', 'published')->whereNotNull('slug')->get()->each(function (Post $post) use ($sitemap) {
            $url = Url::create(url('/blog/' . $post->slug))
                ->setLastModificationDate($post->updated_at ?? now())
                ->setPriority(0.6)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY);

            if ($post->image) {
                $url->addImage(Media::url($post->image), $post->title);
            }

            $sitemap->add($url);
        });

        return $sitemap->render();
    });

    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
});
