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

Route::post("/users", "UsersController@store");

Route::post('/profile', 'ProfilesController@update');
Route::post('/profile/password', 'ProfilesController@updatePassword');
Route::post('/profile/profile-picture', 'ProfilesController@updateProfilePicture');
Route::delete('/profile/profile-picture', 'ProfilesController@destroyProfilePicture');

Route::post('/ingredients/{ingredient}/picture', 'IngredientsController@updatePicture');
Route::apiResource('/ingredients', 'IngredientsController')->except('index');

Route::apiResource('/potion-categories', 'PotionCategoriesController')
    ->parameters(['potion_category' => 'potionCategory']);

Route::apiResource('/potion-difficulty-levels', 'PotionDifficultyLevelsController')
    ->parameters(['potion_difficulty_level' => 'difficultyLevel']);

Route::post('/potions', 'PotionsController@store');
Route::put('/potions/{potion}', 'PotionsController@update');