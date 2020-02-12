<?php

namespace App\Providers;

use App\Support\Faker\PotionsProvider;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Faker\Generator::class, function($app) {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new PotionsProvider());
            return $faker;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
