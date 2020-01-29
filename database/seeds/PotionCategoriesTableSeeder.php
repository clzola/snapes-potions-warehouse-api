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
        factory(\App\PotionCategory::class, 5)->create();
    }
}
