<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotionRecipeIngredientPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potion_recipe_ingredient', function (Blueprint $table) {
            $table->unsignedBigInteger('potion_recipe_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->unsignedInteger('amount')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->unsignedBigInteger('named_amount_id')->nullable();

            $table->primary(['potion_recipe_id', 'ingredient_id']);

            $table->foreign('potion_recipe_id')
                ->on('potion_recipes')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('ingredient_id')
                ->on('ingredients')->references('id')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('named_amount_id')
                ->on('named_amounts')->references('id')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potion_recipe_ingredient');
    }
}
