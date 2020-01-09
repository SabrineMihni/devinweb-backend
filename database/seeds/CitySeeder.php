<?php

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
        $cities = ['Rabat', 'Casa', 'Tangier'];

        foreach ($cities as $city) {

            \Illuminate\Support\Facades\DB::table('cities')->insert([
                'name' => $city,
                'slug' => $city
            ]);

        }

    }
}
