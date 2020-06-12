<?php

use Illuminate\Database\Seeder;

class TariffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $names = ['default', 'ОМОН', 'СОБР', 'АЛЬФА', 'ГРУ'];
        $descriptions = [
            'default',
            'Тариф - <strong>ОМОН</strong>, дающий доступ к контенту на 30 дней<br> + 100 руб на баланс<br> + 5% скиду в нашем магазине!',
            'Тариф - <strong>СОБР</strong>, дающий доступ к контенту на 30 дней<br> + 500 руб на баланс<br> + 7% скиду в нашем магазине<br> + доступ к чату',
            'Тариф - <strong>АЛЬФА</strong>, дающий доступ к контенту на 30 дней<br> + 1000 руб на баланс<br> + 10% скиду в нашем магазине<br> + доступ к чату',
            'Тариф - <strong>ГРУ</strong>, дающий доступ к контенту на 30 дней<br> + 2000 руб на баланс<br> + 15% скиду в нашем магазине<br> + доступ к чату'
        ];
        $costs = ['0', '100', '500', '1000', '2000'];
        $days = ['0', '30', '30', '30', '30'];

        $enables = ['0', '1', '1', '1', '1'];

        for($i = 0; $i <= 4; $i++){

            if(isset($names[$i])) {
                $data[] = [
                    'name' => $names[$i],
                    'description' => $descriptions[$i],
                    'cost' => $costs[$i],
                    'days' => $days[$i],
                    'enable' => $enables[$i],
                    'created_at' => date("Y-m-d H:i:s"),
                ];
            }

        }

        DB::table('tariffs')->insert($data);
    }
}
