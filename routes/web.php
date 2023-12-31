<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\MoodConfigurationController;
use App\Http\Controllers\Admin\MoodController;
use App\Http\Controllers\Admin\MoodResultController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin/users-profile', function () {
    return view('admin.users_profile');
});

Route::resource('/admin/users', UserController::class);

Route::get('/admin/users/detail', function () {
    return view('admin.users.detail');
});

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::prefix('admin')->group(function () {
    Route::get('questions', [QuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('questions/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('questions', [QuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('questions/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('admin.questions.destroy');
    Route::resource('mood-configurations', MoodConfigurationController::class);
});
Route::post('/admin/mood-configurations/store', [MoodConfigurationController::class, 'store']);
Route::get('/admin/mood-configurations', [MoodConfigurationController::class, 'index'])->name('admin.mood_configurations.index');
Route::resource('admin/mood-results', MoodResultController::class);
Route::post('admin/mood-results/{id}/determine-mood', [MoodResultController::class, 'determineMood'])
    ->name('admin.mood-results.determine-mood');

Route::get('/admin/moods/create/{user_id}', [MoodController::class, 'create'])->name('admin.moods.create');
Route::post('/admin/moods/store', [MoodController::class, 'store'])->name('admin.moods.store');
Route::resource('admin/moods', MoodController::class);
Route::put('admin/moods/{id}/update', [MoodController::class, 'update'])->name('admin.moods.update');


// Route::get('/admin/mood-configurations', [MoodConfigurationController::class, 'index']);

Route::get('/admin/load-answer-options/{questionId}', [MoodConfigurationController::class, 'loadAnswers']);



// Route::middleware(['auth:sanctum', 'verified', 'can:administer'])->group(function () {
//     Route::resource('admin/mood-configurations', MoodConfigurationController::class);
// });
