<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('panel', [ MainController::class, 'dashboard'])->name('dashboard');
    Route::get('quiz/detail/{slug}', [ MainController::class, 'quiz_detail'])->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result', [MainController::class, 'result'])->name('quiz.result');
});



Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz/{quiz_id}/questions', QuestionController::class);
});
