<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'warranty', 'power_factor', 'base', 'certification', 'description', 'category_id', 'slug'];

    public function uses()
    {
        return $this->belongsToMany(ProductUse::class, 'product_use_product', 'product_id', 'product_use_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
