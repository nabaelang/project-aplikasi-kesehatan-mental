<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MoodController;

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

Route::apiResource('moods', MoodController::class);
Route::post('moods/track', [MoodController::class, 'trackMood']);
Route::get('users/{userId}/moods', [MoodController::class, 'getUserMoodHistory']);
Route::get('users/{userId}/moods/{date}', [MoodController::class, 'getUserDailyMood']);
Route::get('questions/{date}', [MoodController::class, 'getQuestionsByDate']);
Route::post('questions', [MoodController::class, 'storeQuestion']);
