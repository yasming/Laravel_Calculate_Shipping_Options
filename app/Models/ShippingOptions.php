<?php

namespace App\Models;

use App\Collections\ShippingOptionsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',                      
        'constant_for_delivery_fee',
        'max_height',
        'min_height',
        'max_width',
        'min_width',
        'deadline'                  
    ];

    public function newCollection(array $models = [])
    {
        return new ShippingOptionsCollection($models);
    }
}
