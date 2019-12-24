<?php

Route::post("/token", 'Auth\RequestAccessTokenController')->name('get-token');
Route::post('/token/refresh', 'Auth\RefreshAccessTokenController')->name('refresh-token');
Route::post('/logout', 'Auth\LogoutController')->name('logout');

Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.forgot');
Route::post('/reset-password', 'Auth\ResetPasswordController@reset')->name('password.reset');