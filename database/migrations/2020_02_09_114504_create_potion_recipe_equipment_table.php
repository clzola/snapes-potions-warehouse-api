<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotionRecipeEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potion_recipe_equipment', function (Blueprint $table) {
            $table->unsignedBigInteger('potion_recipe_id');
            $table->unsignedBigInteger('equipment_id');

            $table->primary(['potion_recipe_id', 'equipment_id']);

            $table->foreign('potion_recipe_id')
                ->on('potion_recipes')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('equipment_id')
                ->on('equipments')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potion_recipe_equipment');
    }
}
