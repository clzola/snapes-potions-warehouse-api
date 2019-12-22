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

Route::post('/ingredients', 'IngredientsController@store');
Route::post('/ingredients/{ingredients}', 'IngredientsController@update');
Route::post('/ingredients/{ingredients}/picture', 'IngredientsController@updatePicture');