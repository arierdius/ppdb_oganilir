<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ApiController::class)->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::post('/login', 'login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/add-koordinat', 'add_koordinat');
        });

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', 'logout');
        });

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/check-data', 'check_data');
        });


    });
});
