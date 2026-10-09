<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductUse extends Model
{
    protected $fillable = ['name', 'description', 'image', 'meta_title', 'meta_description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_use_product', 'product_use_id', 'product_id');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }
}
