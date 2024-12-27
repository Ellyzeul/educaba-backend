<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthDeveloper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::post('/auth/token', [AuthController::class, 'auth']);
Route::post('/user', [UserController::class, 'create'])->middleware([AuthDeveloper::class]);

Route::middleware(['auth:sanctum', 'on-organization'])->group(function () {
    Route::get('/user', [UserController::class, 'read']);
    Route::get('/user/me', fn(Request $request) => $request->user());
    Route::patch('/user', [UserController::class, 'update']);
    Route::delete('/user', [UserController::class, 'delete']);
    Route::post('/user/change-password', [UserController::class, 'changePassword']);
    Route::post('/user/link-organization', [UserController::class, 'linkOrganization']);
    Route::post('/user/unlink-organization', [UserController::class, 'unlinkOrganization']);

    Route::patch('/organization', [OrganizationController::class, 'update']);

    Route::post('/patient', [PatientController::class, 'create']);
    Route::patch('/patient', [PatientController::class, 'update']);
    Route::delete('/patient', [PatientController::class, 'delete']);

    Route::get('/program', [ProgramController::class, 'read']);
    Route::post('/program', [ProgramController::class, 'create']);
    Route::put('/program', [ProgramController::class, 'update']);
});

$unauthenticatedCallback = function() {
    return response(['message' => 'unauthenticated...'], Response::HTTP_UNAUTHORIZED);
};

Route::get('/fallback', $unauthenticatedCallback)->name('login');
Route::post('/fallback', $unauthenticatedCallback);
Route::put('/fallback', $unauthenticatedCallback);
Route::patch('/fallback', $unauthenticatedCallback);
Route::delete('/fallback', $unauthenticatedCallback);
