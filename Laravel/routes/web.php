<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeuzdeelController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/register', function () {
    return view('register');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/keuzedelen', [KeuzdeelController::class, 'index'])->name('keuzedelen.index');
    Route::get('/keuzedelen/{keuzedeel}', [KeuzdeelController::class, 'show'])->name('keuzedelen.show');

    Route::post('/keuzedelen/{keuzedeel}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/keuzedelen/{keuzedeel}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/keuzedelen/create', [KeuzdeelController::class, 'create'])->name('keuzedelen.create');
    Route::post('/keuzedelen', [KeuzdeelController::class, 'store'])->name('keuzedelen.store');
    Route::get('/keuzedelen/{keuzedeel}/edit', [KeuzdeelController::class, 'edit'])->name('keuzedelen.edit');
    Route::put('/keuzedelen/{keuzedeel}', [KeuzdeelController::class, 'update'])->name('keuzedelen.update');
    Route::delete('/keuzedelen/{keuzedeel}', [KeuzdeelController::class, 'destroy'])->name('keuzedelen.destroy');
});

require __DIR__ . '/auth.php';
