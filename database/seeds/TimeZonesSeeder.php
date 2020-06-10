<?php

use Illuminate\Database\Seeder;

class TimeZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'country_id' => 1,
            'timezone_name' => "Москва",
            'timezone_utc' => "UTC+3",

            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        $data[] = [
            'country_id' => 2,
            'timezone_name' => "Киев",
            'timezone_utc' => "UTC+5",

            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        //DB::table('time_zones')->insert($data);
        $countries = \App\Models\Users\TimeZones::getTimeZones();
    }
}
