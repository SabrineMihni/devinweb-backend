<?php

use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = ['Mohamed' => 'Rabat', 'Hassan' => 'Casa', 'Nada' => 'Tangier'];
        $faker = Faker\Factory::create();

        foreach ($partners as $key => $value) {
            $city = \App\Models\City::where('name', $value)->first();
            \Illuminate\Support\Facades\DB::table('partners')->insert([
                'name' => $key,
                'email' => $key.'@gmail.com',
                'phone' => $faker->phoneNumber,
                'city_id' => $city->id

            ]);

        }
    }
}
