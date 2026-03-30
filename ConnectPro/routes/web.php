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
    Route::post('/choose-account/store', [ChooseAccountController::class, 'store'])->name('choose-account.store');
    Route::post('/client-dashboard', [ChooseAccountController::class, 'dash'])->name('client-dashboard'); // ✅ fix


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::get('/client-dashboard', function () {
    return view('dashboard.user');
})->name('client-dashboard');

// Route::get('/client-professional', function () {
//     return view('dashboard.professionnel');
// })->name('client-professionnel');




Route::get('/dashboard-professional-test', function () {
    // Fake posts data
    $posts = collect([
        (object)[
            'user' => (object)['name' => 'Dr. Mohamed', 'photo' => 'https://cdn-icons-png.flaticon.com/512/1077/1077063.png'],
            'content' => 'Je propose un service de consultation médicale à domicile.',
            'image' => null,
            'created_at' => now(),
            'category' => 'Médecine',
            'speciality' => 'Généraliste'   
        ],
        (object)[
            'user' => (object)['name' => 'Mme. Sara', 'photo' => null],
            'content' => 'Nouvelle spécialité en nutrition disponible !',
            'image' => 'https://via.placeholder.com/400x200',
            'created_at' => now(),
            'category' => 'Nutrition',
            'speciality' => 'Diététicienne'
        ]
    ]);

    return view('dashboard.professionnel', compact('posts'));
});

Route::post('/choose-account', [ChooseAccountController::class, 'store']);


