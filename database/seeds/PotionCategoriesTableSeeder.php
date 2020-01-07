<?php

use Illuminate\Database\Seeder;

class PotionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            \App\PotionCategory::create([
                "name" => "Potion Category $i",
                "description" => "Lorem ipsum description",
            ]);
        }
    }
}
