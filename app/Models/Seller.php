<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use function Symfony\Component\Translation\t;

class Seller extends User
{

    protected static function booted()
    {
        static::addGlobalScope('is_seller', function (Builder $builder){
            $builder->where('is_seller', true);
        });
    }

    public function products(){
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function productsWhereHasOrder(){
        return $this->products()->whereHas('orders');
    }

    public function sellerOrders()
    {
        return $this->hasManyThrough(Order::class, Product::class, 'seller_id', 'product_id');
    }

}
