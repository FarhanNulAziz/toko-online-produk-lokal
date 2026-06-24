<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'customer_name',
        'phone',
        'address',
        'quantity',
        'total_price',
        'payment_method',
        'status',
        'order_date',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}