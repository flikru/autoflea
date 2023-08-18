<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Parse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $cities = City::factory(10)->create();
        $parses = Parse::factory(30)->create();
        foreach($parses as $parse){
            $zn = rand(0,3);
            $cityId = $cities->random($zn)->pluck('id');
            $parse->cities()->attach($cityId);
        }
        // \App\Models\User::factory(10)->create();
    }
}
