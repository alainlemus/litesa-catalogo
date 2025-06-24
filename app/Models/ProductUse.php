<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUse extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_use_product', 'product_use_id', 'product_id');
    }
}