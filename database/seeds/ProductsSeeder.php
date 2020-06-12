<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'category_id' => 1,
            'alias' => 'default',
            'name' => 'default',
            'description' => 'default',
            'image' => 'default',
            'enable' => 0,
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        DB::table('products')->insert($data);

    }
}
