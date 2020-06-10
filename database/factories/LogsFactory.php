<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Bot\Logs::class, function (Faker $faker) {
    return [

        'description' => $faker->realText(200),
        'updated_at' => null,
        'created_at' => date("Y-m-d H:i:s"),
        'deleted_at' => null,

    ];
});
