<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\Auth\AuthController;


Route::get('/register', [AuthController::class, 'registration'])->name('register');

// Handle registration form submission
Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');

// Login Routes
Route::get('/login', [AuthController::class, 'displayLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Route (Dashboard)
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/', function () {
    return view('auth.login');
});
