<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuestionController;

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
    return view('welcome');
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
});
