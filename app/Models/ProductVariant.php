<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'variant_id', 'pcs', 'description', 'size', 'power', 'lumen', 'voltage', 'color_temperature_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function colorTemperature()
    {
        return $this->belongsTo(ColorTemperature::class, 'color_temperature_id');
    }
}