<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'category_id',
    'name',
    'description',
    'price',
    'stock',
    'image',
    'seller_name',
    'is_active',
];
}
