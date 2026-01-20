<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class PopulateProductSlugs extends Command
{
    protected $signature = 'app:populate-product-slugs';
    protected $description = 'Genera slugs únicos para todos los productos que no tengan slug';

    public function handle(): int
    {
        $count = 0;
        foreach (Product::all() as $product) {
            if (empty($product->slug)) {
                $baseSlug = Str::slug($product->name);
                $slug = $baseSlug;
                $counter = 2;
                while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }
                $product->slug = $slug;
                $product->save();
                $count++;
            }
        }
        $this->info("Slugs generados para {$count} productos.");
        return self::SUCCESS;
    }
}
