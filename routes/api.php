<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MoodController;
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\MoodResultController;
use App\Http\Controllers\API\UserController;
use App\Mail\NotifMoodResult;
use Illuminate\Support\Facades\Mail;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('questions/{date}', [MoodController::class, 'getQuestionsByDate']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::apiResource('moods', MoodController::class);
Route::post('moods/track', [MoodController::class, 'trackMood']);
Route::get('users/{userId}/moods', [MoodController::class, 'getUserMoodHistory']);
Route::get('users/{userId}/moods/{date}', [MoodController::class, 'getUserDailyMood']); // ini blm dicoba
// Route::get('questions/{date}', [MoodController::class, 'getQuestionsByDate']);
Route::post('questions', [MoodController::class, 'storeQuestion']);
Route::post('/answers', [AnswerController::class, 'store']);
Route::post('/answers/multiple', [AnswerController::class, 'storeMultiple']);
Route::get('questions/{questionId}/answers', [AnswerController::class, 'getByQuestion']);
Route::post('/mood-result', [MoodResultController::class, 'store']);
Route::get('/article', [ArticleController::class, 'index']);

// Route::get('notif-mood-result', function () {
//     $email = new NotifMoodResult();
//     Mail::to('fardikhalikramadhan@gmail.com')->send($email);

//     return 'success send email';
// });
