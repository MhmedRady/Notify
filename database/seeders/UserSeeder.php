<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'Admin@localhost',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
                'is_seller' => true,
                'is_delivery' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Seller',
                'email' => 'seller@localhost',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
                'is_seller' => true,
                'is_delivery' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'user@localhost',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
                'is_seller' => false,
                'is_delivery' => false,
                'created_at' => now(),
            ],
            [
                'name' => 'Delivery 1',
                'email' => 'delivery_1@localhost',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
                'is_seller' => false,
                'is_delivery' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Delivery 2',
                'email' => 'delivery_2@localhost',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => \Str::random(10),
                'is_seller' => false,
                'is_delivery' => true,
                'created_at' => now(),
            ],
        ];
        User::query()->insert($users);
    }
}
