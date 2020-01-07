<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Ingredient::create([
            "name" => "Ingredient 1",
            "description" => "Lorem ipsum description",
            "picture" => "asdasd.jpg",
            "amount" => 5000,
            "measurement_unit" => "g",
        ]);

        \App\Ingredient::create([
            "name" => "Ingredient 2",
            "description" => "Lorem ipsum description",
            "picture" => "asdasd.jpg",
            "amount" => 5000,
            "measurement_unit" => "g",
        ]);

        \App\Ingredient::create([
            "name" => "Ingredient 3",
            "description" => "Lorem ipsum description",
            "picture" => "asdasd.jpg",
            "amount" => 5000,
            "measurement_unit" => "g",
        ]);
    }
}
