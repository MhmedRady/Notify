<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;


class Delivery extends User
{
    protected static function booted()
    {
        static::addGlobalScope('is_delivery', function (Builder $builder){
            $builder->where('is_delivery', true);
        });
    }

    public function deliveryOrders()
    {
        return $this->hasMany(Order::class);
    }

}
