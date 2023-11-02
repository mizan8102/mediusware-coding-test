<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth:sanctum'])->group(function () {
   
    Route::get('/', [TransactionController::class,'index']);
    Route::get('/deposit', [TransactionController::class,'show']);
    Route::post('/deposit', [TransactionController::class,'deposit']);
    Route::get('/withdrawal', [TransactionController::class,'withdrawAll']);
    Route::post('/withdrawal', [TransactionController::class,'withdrawAmount']);

});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class,'store']);
