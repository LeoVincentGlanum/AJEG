<?php

use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TournoisController;
use App\Http\Controllers\GameHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');


Route::get('/', function () {
    return view('welcome');
});

//Dashboard
Route::get('/dashboard', [\App\Http\Controllers\AccountController::class, 'login'])
    ->name('dashboard');

//Statistique joueur
Route::get('/my-account', [\App\Http\Controllers\AccountController::class, 'myaccount'])
    ->name('my-account');
Route::get('/profile/{id}', [\App\Http\Controllers\AccountController::class, 'profileuser'])
    ->name('profile-user');


// Historique

Route::get('/game-history', [GameHistoryController::class, 'gameHistory'])
     ->name('gameHistory');

// Récompense quotidienne

Route::get('/daily-reward', [AccountController::class, 'dailyReward'])
     ->name('dailyReward');

// Tournois
Route::get('/newTournois', [TournoisController::class, 'index'])->name('newTournois');
Route::get('/tournois/{id}', [TournoisController::class, 'show'])->name('tournois.show');


// Game
Route::get('/game/create', [GameController::class, 'create'])->name('game.create')->middleware('auth');
Route::get('/game/show/{id}', [GameController::class, 'show'])->name('game.show')->middleware('auth');

// admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');

require __DIR__.'/auth.php';
