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

require __DIR__ . '/api_auth.php';
