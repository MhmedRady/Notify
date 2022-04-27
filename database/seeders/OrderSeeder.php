<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::query()->limit(5)->get()->all();

        $orders = array_map(function ($product){
            return [
                'user_id' => 3,
                'product_id' => $product->id,
                'price' => $product->price,
                'user_address_id' => 3
            ];
        },$products);

        Order::query()->insert($orders);

        Order::query()->whereIn('id', [1,4])->update([
            'delivery_id' => 4,
            'arrived_at' => Carbon::tomorrow(),
            'status_id' => 2,
        ]);

        Order::query()->where('id', 2)->update([
            'delivery_id' => 5,
            'shipped_at' => Carbon::yesterday(),
            'arrived_at' => Carbon::yesterday(),
            'status_id' => 3,
        ]);
    }
}
