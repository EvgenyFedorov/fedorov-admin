<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shop\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'alias' => Str::random(10),
        'name' => $faker->realText(25),
        'description' => $faker->realText(200),
        'image' => $faker->url,
        'enable' => 1,
        'updated_at' => null,
        'created_at' => date("Y-m-d H:i:s"),
        'deleted_at' => null,
    ];
});
