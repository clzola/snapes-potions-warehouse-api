<?php

Route::post("/token", 'Auth\RequestAccessTokenController');
Route::post('/token/refresh', 'Auth\RefreshAccessTokenController');
Route::post('/logout', 'Auth\LogoutController');