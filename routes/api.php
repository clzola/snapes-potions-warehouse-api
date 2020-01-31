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

Route::get('/users', 'UsersController@index')->name('users.index');
Route::post('/users', 'UsersController@store')->name('users.store');

Route::get('/profile', 'ProfilesController@show')->name('profile.get');
Route::post('/profile', 'ProfilesController@update')->name('profile.update');
Route::post('/profile/password', 'ProfilesController@updatePassword')->name('profile.update-password');
Route::post('/profile/profile-picture', 'ProfilesController@updateProfilePicture')->name('profile.update-picture');
Route::delete('/profile/profile-picture', 'ProfilesController@destroyProfilePicture')->name('profile.delete-picture');

Route::get('/ingredients/search', 'SearchIngredientsController')->name('ingredients.search');
Route::post('/ingredients/add', 'AddIngredientsController')->name('ingredients.add');
Route::apiResource('/ingredients', 'IngredientsController')->except('index');

Route::apiResource('/potion-categories', 'PotionCategoriesController')
    ->parameters(['potion-categories' => 'potionCategory']);

Route::apiResource('/potion-difficulty-levels', 'PotionDifficultyLevelsController')
    ->parameters(['potion-difficulty-levels' => 'difficultyLevel']);

Route::get('/potions/search', 'SearchPotionsController')->name('potions.search');
Route::apiResource('/potions', 'PotionsController');

Route::get('/potions/{potion}/recipe', 'PotionRecipesController@show')->name('potions.recipe.show');
Route::post('/potions/{potion}/recipe', 'PotionRecipesController@store')->name('potions.recipe.store');
Route::put('/potions/{potion}/recipe', 'PotionRecipesController@update')->name('potions.recipe.update');
