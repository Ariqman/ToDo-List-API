<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {

    dd('Welcome to admin user routes.');

});

Route::post('/login', [AdminController::class, 'adminLogin']);
Route::get('/listUser', [AdminController::class, 'index'])->middleware(['auth:api', 'scope:admin']);
Route::get('/changeToUser/{id}',[AdminController::class,'updateUser'])->middleware(['auth:api', 'scope:superadmin']);
Route::get('/changeToAdmin/{id}',[AdminController::class,'updateAdmin'])->middleware(['auth:api', 'scope:superadmin']);