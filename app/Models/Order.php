<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
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
    protected $casts = [
        'order_date' => 'datetime',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}