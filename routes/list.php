<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\toDoController\toDoController;



Route::namespace('Auth')->group(function () {
});

Route::group([
    'middleware' => 'api'
], function () {
    Route::get("/", [toDoController::class, 'index']);
    Route::get("/user/{id}", [toDoController::class, 'userIndex']);
    Route::get("/detail/{id}", [toDoController::class, 'detail']);
    Route::post("/add", [toDoController::class, 'create']);
    Route::post("/update/{id}", [toDoController::class, 'update']);
    Route::delete("/delete/{id}", [toDoController::class, 'delete']);
    Route::put("/status/{id}", [toDoController::class, "updateStatus"]);
});
