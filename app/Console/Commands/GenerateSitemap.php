<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Product;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sitemap = Sitemap::create();

        // Página principal
        $sitemap->add(Url::create('/'));

        // Blog principal
        $sitemap->add(Url::create('/blog'));

        // Entradas del blog
        foreach (Post::all() as $post) {
            $sitemap->add(Url::create(route('blog.show', $post->slug)));
        }

        // Catálogo de productos
        $sitemap->add(Url::create('/catalogo'));

        // Productos
        foreach (Product::all() as $product) {
            $sitemap->add(Url::create(route('product.show', $product->slug)));
        }

        // Otras páginas estáticas
        $sitemap->add(Url::create('/contacto'));
        $sitemap->add(Url::create('/iluminacion'));
        $sitemap->add(Url::create('/aviso-de-privacidad'));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generado correctamente.');
        return self::SUCCESS;
    }
}
