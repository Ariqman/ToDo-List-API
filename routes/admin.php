<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {

    dd('Welcome to admin user routes.');

});

Route::post('/login', [AdminController::class, 'adminLogin']);
Route::post('/logout', [AdminController::class, 'logout']);
Route::post('/list-user', [AdminController::class, 'index']);
Route::post('/update-user/{id}', [AdminController::class, 'update']);
Route::post('/delete-user/{id}',[AdminController::class,'deleteUser']);
