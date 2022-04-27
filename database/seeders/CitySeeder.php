<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'name' => 'Cairo',
                'created_at' => now()
            ],
            [
                'name' => 'Giza',
                'created_at' => now()
            ],
        ];
        City::query()->insert($cities);

    }
}
