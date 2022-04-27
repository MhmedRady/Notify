<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'user_id',
        'delivery_id',
        'product_id',
        'price',
        'user_address_id',
        'shipped_at',
        'arrived_at',
        'received_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
