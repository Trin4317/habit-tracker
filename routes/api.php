<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/habits', [HabitApiController::class, 'index']);
Route::post('/habits', [HabitApiController::class, 'store']);
Route::put('/habits/{habit}', [HabitApiController::class, 'update']);
Route::delete('/habits/{habit}', [HabitApiController::class, 'destroy']);
Route::post('/habits/{habit}/execute', [HabitApiController::class, 'execute']);
