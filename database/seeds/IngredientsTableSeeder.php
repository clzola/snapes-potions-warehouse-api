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
        $this->copyPictures();
        factory(\App\Ingredient::class, 70)->create();
    }


    private function copyPictures()
    {
        if(!Storage::exists("public/ingredients/pictures"))
            Storage::makeDirectory("public/ingredients/pictures");

        Storage::delete(Storage::allFiles("public/ingredients/pictures"));

        collect(Storage::allFiles("seeds/ingredients/pictures"))->each(function($fileName) {
            Storage::copy($fileName, "public/ingredients/pictures/" . basename($fileName));
        });
    }
}
