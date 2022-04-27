<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userAddresses = [
            [
              'address' => '15 Nile ST',
              'city_id' => 1,
                'user_id' => 1,
            ],
            [
                'address' => '10 Tahrir ST',
                'city_id' => 2,
                'user_id' => 2,
            ],
            [
                'address' => '10 Tahrir ST',
                'city_id' => 2,
                'user_id' => 3,
            ],
            [
                'address' => '10 Tahrir ST',
                'city_id' => 2,
                'user_id' => 4,
            ],
            [
                'address' => '15 Nile ST',
                'city_id' => 1,
                'user_id' => 5,
            ],

        ];

        UserAddress::query()->insert($userAddresses);
    }
}
