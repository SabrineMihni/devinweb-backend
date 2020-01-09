<?php

use Illuminate\Database\Seeder;

class DeliveryDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $dates = [  "2019-11-05",  "2019-11-06", "2019-11-07", "2019-11-08" , "2019-11-09", "2019-11-10" ];

        foreach ($dates as $date) {

            $d    = new DateTime($date);

            \Illuminate\Support\Facades\DB::table('delivery_dates')->insert([

                'day_name' => $d->format('l'),
                'date' => $date,
                "city_id" => array_rand([1,2,3], 1) + 1,
                "excluded" => false

            ]);

        }
    }
}
