<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified.api'])->get('/sample', function (Request $request) {
    return
        [
        'success' => true,
        'request-user' => $request->user(),
        'auth' => Auth::user(),
        'data' => ['Some data from the database'],
    ];

});

// Route::group(['auth', 'auth:sanctum'], function () {
//     Route::get('/sample2', function (Request $request) {
//         return
//             [
//             'success' => true,
//             'request-user' => $request->user(),
//             'auth' => Auth::user(),
//             'data' => ['Some data from the database'],
//         ];

//     })->middleware(['verified']);

//     Route::get('/sample3', function (Request $request) {
//         return
//             [
//             'success' => true,
//             'request-user' => $request->user(),
//             'auth' => Auth::user(),
//             'data' => ['Some data from the database'],
//         ];

//     });

// });

Route::post(
    '/register',
    [App\Http\Controllers\Api\RegisterController::class, 'register']
)->name('register');

Route::post(
    '/login',
    [App\Http\Controllers\Api\LoginController::class, 'login']
)->name('login');

Route::post(
    '/resend/email/token',
    [App\Http\Controllers\Api\RegisterController::class, 'resendPin']
)->name('resendPin');

Route::middleware('auth:sanctum')->group(function () {
    Route::post(
        'email/verify',
        [App\Http\Controllers\Api\RegisterController::class, 'verifyEmail']
    );
    // Route::middleware('verify.api')->group(function () {
    Route::post(
        '/logout',
        [App\Http\Controllers\Api\LoginController::class, 'logout']
    );
    // });
});

// Route::post(
//     '/forgot-password',
//     [App\Http\Controllers\Api\ForgotPasswordController::class, 'forgotPassword']
// );
// Route::post(
//     '/verify/pin',
//     [App\Http\Controllers\Api\ForgotPasswordController::class, 'verifyPin']
// );
// Route::post(
//     '/reset-password',
//     [App\Http\Controllers\Api\ResetPasswordController::class, 'resetPassword']
// );
