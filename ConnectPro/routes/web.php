<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\professionnel\ProfileControllerPr;
use App\Http\Controllers\professionnel\ProfessionnelController;
use App\Http\Controllers\utilisateur\profileControleurUt;

//Public Routes

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);


Route::get('/forgot-password', function () {
    return view('auth.forgot-password'); 
})->name('password.request');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Authenticated Routes

Route::middleware('auth')->group(function () {

    Route::get('/choose-account', [ChooseAccountController::class, 'index'])->name('choose-account');
    Route::post('/client-dashboard', [ChooseAccountController::class, 'dash'])->name('client-dashboard'); 
    Route::get('/Professionnel/professionel',[ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/profile_Professionnel/store', [ChooseAccountController::class, 'store'])->name('choose-account.store');

});



// *******************************professionnel******************************************
                               
Route::get('/profile',        [ProfileControllerPr::class, 'index'])->name('profilePr');
Route::get('/profile/edit',   [ProfileControllerPr::class, 'edit'])->name('profilePrEdit');
// Route::put('/profile/update', [ProfileControllerPr::class, 'update'])->name('profilePr.update');

// ************************************utilisateur************************************************
Route::get('/utilisateur/Profile',[profileControleurUt::class, 'index'])->name('profileUser');
Route::get('/profile/Edit', [profileControleurUt::class, 'edit'])->name('profileUt.edit');
Route::put('/profile/Update', [profileControleurUt::class, 'update'])->name('profileUt.update');





//supprimer ces routers
// Route::post('/client_dashboard', [ChooseAccountController::class, 'store']);
// Route::get('/dashboard/professionnel', [ProfessionnelController::class, 'index'])->name('dashboardPr');


// Route::get('dashboard professionnel',function(){
//     return view('dashboard.professionnel');
// })->name('dashboard.professionnel');