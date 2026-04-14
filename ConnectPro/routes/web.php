<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChooseAccountController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('welcome');
});

// LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

// FORGOT PASSWORD
Route::get('/forgot-password', function () {
    return view('auth.forgot-password'); 
})->name('password.request');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {


    Route::get('/choose-account', [ChooseAccountController::class, 'index'])->name('choose-account');
    Route::post('/client-dashboard', [ChooseAccountController::class, 'dash'])->name('client-dashboard'); 
    Route::get('/profile_Professionnel',[ProfileController::class, 'index'])->name('profile.profile');
    Route::post('/profile_Professionnel/store', [ChooseAccountController::class, 'store'])->name('choose-account.store');

});


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');




// Route::post('/client_dashboard', [ChooseAccountController::class, 'store']);










