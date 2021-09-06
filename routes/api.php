<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function() {
	Route::post('/login', [AdminController::class, 'adminLogin']);
    Route::get('/listUser', [AdminController::class, 'index'])->middleware(['auth:api', 'scope:admin']);
    Route::get('/changeToUser/{id}',[AdminController::class,'updateUser'])->middleware(['auth:api', 'scope:superadmin']);
    Route::get('/changeToAdmin/{id}',[AdminController::class,'updateAdmin'])->middleware(['auth:api', 'scope:superadmin']);
});

# Test buat user biasa
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);


