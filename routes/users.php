<?php
Route::namespace ('Auth')->group(function(){
    
    Route::post('register','RegisterController@__invoke');
    Route::post('login','LoginController@login');
    Route::post('logout','LogoutController@logout');
});

Route::get('home','UserController@home');