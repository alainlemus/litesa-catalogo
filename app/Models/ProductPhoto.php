<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['product_id', 'path', 'description', 'alt_text'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}