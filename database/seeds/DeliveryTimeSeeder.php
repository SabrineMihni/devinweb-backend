<?php

use Illuminate\Database\Seeder;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = ["9->12", "14->18", "10->13", "15->19" , "9->13", "18->20" ];

        foreach ($times as $time) {

            \Illuminate\Support\Facades\DB::table('delivery_times')->insert([

                'delivery_at' => $time,
                "delivery_date_id" => array_rand(range(1, 6), 1) + 1,
                "excluded" => false,
                "city_id" => array_rand([1,2,3], 1) + 1,

            ]);

        }
    }
}
