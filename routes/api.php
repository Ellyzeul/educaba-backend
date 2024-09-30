<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthDeveloper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::post('/auth/token', [AuthController::class, 'auth']);
Route::post('/user/register', [UserController::class, 'create'])->middleware([AuthDeveloper::class]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/login', function () {
    return response([
        'message' => 'not authenticated...'
    ], Response::HTTP_UNAUTHORIZED);
})->name('login');
