<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
Route::put('/habits/{habit}', [HabitController::class, 'update'])->name('habits.update');
