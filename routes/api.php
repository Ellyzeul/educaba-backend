<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthDeveloper;
use App\Http\Middleware\EnsureUserIsOnOrganization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::post('/auth/token', [AuthController::class, 'auth']);
Route::post('/user', [UserController::class, 'create'])->middleware([AuthDeveloper::class]);

Route::middleware(['auth:sanctum', 'on-organization'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/fallback', fn() => response([
    'message' => 'unauthenticated...',
], Response::HTTP_UNAUTHORIZED))->name('login');
