<?php

use Illuminate\Database\Seeder;

class PotionDifficultyLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PotionDifficultyLevel::create([
            "name" => "Novice",
            "description" => "Lorem description",
            "order" => 1
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Beginner",
            "description" => "Lorem description",
            "order" => 2
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Intermediate",
            "description" => "Lorem description",
            "order" => 3
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Advanced",
            "description" => "Lorem description",
            "order" => 4
        ]);
    }
}
