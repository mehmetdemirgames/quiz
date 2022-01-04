<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->get('/panel', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::resource('quizzes', QuizController::class);
    
});