<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PotionCategory;
use Faker\Generator as Faker;

$factory->define(PotionCategory::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word),
        'description' => $faker->paragraph
    ];
});
