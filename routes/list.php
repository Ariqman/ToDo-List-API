<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\toDoController\toDoController;



Route::get("/", [toDoController::class, 'index']);
Route::post("/add", [toDoController::class, 'create']);
Route::post("/update/{id}", [toDoController::class, 'update']);
Route::delete("/delete/{id}", [toDoController::class, 'delete']);
Route::put("/status/{id}", [toDoController::class, "updateStatus"]);
