<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/my-account', function () {
        return view('user.account');
    })->name('my-account');

    Route::get('/profile/{id}', [AccountController::class, 'getProfile'])->name('profile-user');

    Route::get('/game-history', [GameHistoryController::class, 'gameHistory'])->name('gameHistory');

    Route::get('/daily-reward', [AccountController::class, 'dailyReward'])->name('dailyReward');

    Route::prefix('/tournament')->group(function () {
        Route::get('/', [TournoisController::class, 'index'])->name('tournament.index');
        Route::get('/show/{id}', [TournoisController::class, 'show'])->name('tournament.show');
    });

    Route::prefix('/game')->group(function () {
        Route::get('/create', [GameController::class, 'create'])->name('game.create');
        Route::get('/show/{id}', [GameController::class, 'show'])->name('game.show');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::fallback(function () {
    return redirect('login');
});

require __DIR__.'/auth.php';
