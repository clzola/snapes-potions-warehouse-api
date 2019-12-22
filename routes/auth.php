<?php

Route::post("/token", 'Auth\RequestAccessTokenController');
Route::post('/token/refresh', 'Auth\RefreshAccessTokenController');
Route::post('/logout', 'Auth\LogoutController');

Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/reset-password', 'Auth\ResetPasswordController@reset')->name('password.reset');