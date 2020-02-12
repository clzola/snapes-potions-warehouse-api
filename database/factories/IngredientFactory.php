<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredient;
use Faker\Generator as Faker;


$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->ingredientName,
        'description' => $faker->paragraph(6),
        'picture' => $faker->ingredientPicture,
        'amount' => $faker->numberBetween(100, 7834),
        'measurement_unit' => 'g',
    ];
});
