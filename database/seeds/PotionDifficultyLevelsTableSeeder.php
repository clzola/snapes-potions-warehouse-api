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
            "description" => "Unskilled, Not knowing, New to",
            "order" => 1
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Beginner",
            "description" => "Learning",
            "order" => 2
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Intermediate",
            "description" => "Knows adequately, Qualified",
            "order" => 3
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Advanced",
            "description" => "Practiced, Skillful",
            "order" => 4
        ]);

        \App\PotionDifficultyLevel::create([
            "name" => "Expert",
            "description" => "Well practiced, Having versatile knowledge",
            "order" => 4
        ]);
    }
}
