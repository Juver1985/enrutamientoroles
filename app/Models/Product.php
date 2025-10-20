<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define fillable fields
    protected $fillable = [
        'categor_name',
        'description',
        'price',
        'stock',
    ];
}
