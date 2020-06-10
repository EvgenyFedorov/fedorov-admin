<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'name_ru' => "Россия",
            'name_en' => "Russia",
            'iso_a2' => "RU",
            'iso_a3' => "RUS",
            'iso_code' => "111",
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        $data[] = [
            'name_ru' => "Украина",
            'name_en' => "Ukraine",
            'iso_a2' => "UK",
            'iso_a3' => "UKR",
            'iso_code' => "222",
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        //DB::table('countries')->insert($data);
        $countries = \App\Models\Users\Countries::getCountries();
    }
}
