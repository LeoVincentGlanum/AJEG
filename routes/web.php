<?php

use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TournoisController;

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
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('/user')->group(function () {
        Route::view('/my-account', 'user.account')->name('user.my-account');
        Route::get('/profile/{user}', [UserController::class, 'getProfile'])->name('user.profile');
    });

    Route::prefix('/game')->group(function () {
        Route::get('/create/{game?}', [GameController::class, 'create'])->name('game.create');
        Route::get('/show/{game}', [GameController::class, 'show'])->name('game.show');
        Route::view('/history', 'game.history')->name('game.history');
        Route::get('/ranking', [GameController::class, 'ranking'])->name('game.ranking');
    });

    Route::prefix('/tournament')->group(function () {
        Route::view('/','tournament.index')->name('tournament.index');
        Route::get('/show/{tournament}', [TournamentController::class, 'show'])->name('tournament.show');
        Route::get('/{tournament}', [TournamentController::class, 'edit'])->name('tournament.edit');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin', 'admin.index')->name('admin.index');
});

Route::fallback(function () {
    return redirect('login');
});

require __DIR__.'/auth.php';
