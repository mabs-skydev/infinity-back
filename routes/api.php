<?php

use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('user', function() {
        return response()->json([
            "success" => true,
            "user" => auth()->user()
        ]);
    });

    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/{id}/comment', [PostController::class, 'comment']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
});