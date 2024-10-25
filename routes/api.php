<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthDeveloper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::post('/auth/token', [AuthController::class, 'auth']);
Route::post('/user', [UserController::class, 'create'])->middleware([AuthDeveloper::class]);

Route::middleware(['auth:sanctum', 'on-organization'])->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::patch('/user', [UserController::class, 'update']);
    Route::post('/user/change-password', [UserController::class, 'changePassword']);

    Route::patch('/organization', [OrganizationController::class, 'update']);

    Route::post('/patient', [PatientController::class, 'create']);
});

Route::get('/fallback', fn() => response([
    'message' => 'unauthenticated...',
], Response::HTTP_UNAUTHORIZED))->name('login');
