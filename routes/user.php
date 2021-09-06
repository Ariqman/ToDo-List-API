<?php

Route::namespace ('Auth')->group(function(){
    
    Route::post('register','RegisterController@__invoke');
    Route::post('login','LoginController@login');
});

Route::get('home','UserController@__invoke');