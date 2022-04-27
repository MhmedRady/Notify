<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Restaurants = [
            [
              "name"=> "location 1",
              "address"=> "location 1 address ",
            ],
            [
                "name"=> "location 2",
                "address"=> "location 2 address ",
            ],
            [
                "name"=> "location 3",
                "address"=> "location 3 address ",
            ],
            [
                "name"=> "location 4",
                "address"=> "location 4 address ",
            ],
        ];
        foreach ($Restaurants as $rest){
            Restaurant::query()->create($rest);
        }
    }
}
