<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->json('other_names')->nullable();
            $table->unsignedBigInteger('potion_category_id');
            $table->string('effect');
            $table->json('characteristics');
            $table->json('side_effects')->nullable();
            $table->string('brewing_time');
            $table->unsignedInteger('potion_difficulty_level_id');
            $table->text('description');
            $table->string('picture');
            $table->unsignedInteger('bottles')->default(0);
            $table->timestamps();

            $table->foreign('potion_category_id')
                ->on('potion_categories')->references('id')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('potion_difficulty_level_id')
                ->on('potion_difficulty_levels')->references('id')
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
        Schema::dropIfExists('potions');
    }
}
