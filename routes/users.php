<?php
Route::namespace ('Auth')->group(function(){
    
    Route::post('register','RegisterController@__invoke');
    Route::post('login','LoginController@login');
    Route::post('logout','LogoutController@logout');
    Route::post('forgot-password', 'NewPasswordController@forgotPassword');
    Route::post('reset-password', 'NewPasswordController@reset');
});

Route::get('home','UserController@home');

