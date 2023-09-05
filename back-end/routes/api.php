<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExpenseController;
use Illuminate\Http\Request;
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

//AUTH
Route::post('/auth/login',   [AuthController::class, 'login'])->name('login');


Route::middleware('apiJwt')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('expenses', ExpenseController::class)->except(['create', 'index', 'edit']);
    Route::get('/expenses/{user_id}/user', [ExpenseController::class, 'getByUser'])->name('expenses.user');
});


Route::middleware('apiJwt')->get('/user', function (Request $request) {
    return $request->user();
});
