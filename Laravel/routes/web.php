<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeuzdeelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/register', function () {
    return view('register');
});


Route::get('/keuzedelen',[KeuzdeelController::class, 'Index'])->name('keuzedelen.index');


require __DIR__.'/auth.php';
