<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    });
});

Route::get('/csrf-token', function() {
   return response()->json(['token' => csrf_token()]);
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('specialist', \App\Http\Controllers\SpecialistController::class);
    Route::apiResource('client', \App\Http\Controllers\ClientController::class)->except(['store'])
        ->parameter('client', 'user');
    Route::apiResource('appointment', \App\Http\Controllers\AppointmentController::class);
});

