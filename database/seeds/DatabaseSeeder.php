<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesSeeder::class);
        $this->call(TariffsSeeder::class);
        $this->call(UsersSeeder::class);

        // Запускаем фабрику и генерируем 10 простых юзеров
        factory(\App\Models\User::class, 10)->create()->each(function ($user){
            //
        });

        factory(\App\Models\Shop\Categories::class, 5)->create()->each(function ($category){

            factory(\App\Models\Shop\Products::class, 3)->make()->each(function ($product) use ($category){

                $product->category_id = $category->id;
                $product->save();

            });

        });

        $this->call(VideosSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(SitesSeeder::class);

    }
}
