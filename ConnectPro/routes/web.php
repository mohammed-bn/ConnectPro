<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\professionnel\ProfileControllerPr;
use App\Http\Controllers\professionnel\ProfessionnelController;
use App\Http\Controllers\utilisateur\profileControleurUt;
use App\Http\Controllers\utilisateur\UtilisateurController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DemandeConsultationController;
use App\Http\Controllers\PostController;


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

// auth

Route::middleware('auth')->group(function () {


    //professionnel
    Route::middleware('role:professionnel')->group(function () {
        Route::get('/professionnel/dashboard', [ProfessionnelController::class, 'dashProfessionell'])->name('professionnel.dashboard');
        Route::get('/professionnel', [ProfileControllerPr::class, 'index'])->name('profilePr');
        Route::get('/professionnel/profile/edit', [ProfileControllerPr::class, 'edit'])->name('profilePrEdit');
        Route::put('/professionnel/profile/update', [ProfileControllerPr::class, 'update'])->name('profilePr.update');
        Route::post('/consultation/accept/{id}', [DemandeConsultationController::class, 'accept'])->name('consultation.accept');
        Route::post('/consultation/refuse/{id}', [DemandeConsultationController::class, 'refuse'])->name('consultation.refuse');
    });
    
    // client
    Route::middleware('role:client')->group(function () {
        Route::get('/client/dashboard', [UtilisateurController::class, 'dashClient'])->name('client.dashboard');
        Route::get('/utilisateur', [profileControleurUt::class, 'index'])->name('profileUser');
        Route::post('/send/consultation/{professionalId}', [DemandeConsultationController::class, 'sendRequest'])->name('sendConsultation');
        Route::get('/client/profile/edit', [profileControleurUt::class, 'edit'])->name('profileUt.edit');
        Route::put('/client/profile/Update', [profileControleurUt::class, 'update'])->name('profileUt.update');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dachboardAdmin'])->name('admin.dashboard');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    });
    
    //recherche route
    Route::get('/search/professionals', [SearchController::class, 'searchProfessionals'])->name('search.professionals');

    Route::get('/voir/profile', function () {
        return view('voirProfile');
    })->name('profilee.professionals');

    //publication route
    Route::post('/ajouter/publication', [PostController::class, 'store'])->name('addPost');
    Route::get('/professional/{id}', [ProfessionnelController::class, 'show'])->name('professional.show');

   //notification rout
    Route::get('/notification', [DemandeConsultationController::class, 'Notification'])->name('notification');
    
});