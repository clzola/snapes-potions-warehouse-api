<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/users", "UsersController@store")->name('users.store');

Route::post('/profile', 'ProfilesController@update')->name('profile.get');
Route::post('/profile/password', 'ProfilesController@updatePassword')->name('profile.update-password');
Route::post('/profile/profile-picture', 'ProfilesController@updateProfilePicture')->name('profile.update-picture');
Route::delete('/profile/profile-picture', 'ProfilesController@destroyProfilePicture')->name('profile.delete-picture');

Route::apiResource('/ingredients', 'IngredientsController')->except('index');

Route::apiResource('/potion-categories', 'PotionCategoriesController')
    ->parameters(['potion_category' => 'potionCategory']);

Route::apiResource('/potion-difficulty-levels', 'PotionDifficultyLevelsController')
    ->parameters(['potion_difficulty_level' => 'difficultyLevel']);

Route::apiResource('/potions', 'PotionsController')
    ->except(['index']);

Route::post('/potions/{potion}/recipe', 'PotionRecipesController@store');
Route::get('/potions/{potion}/recipe', 'PotionRecipesController@show');