<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorTemperature extends Model
{
    protected $fillable = ['value'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'color_temperature_id');
    }
}