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

    Route::prefix('/chess')->group(function () {

        Route::view('/dashboard', 'chess.dashboard')->name('chess.dashboard');

        Route::prefix('/user')->group(function () {
            Route::view('/my-account', 'user.account')->name('user.my-account');
            Route::get('/profile/{user}', [UserController::class, 'getProfile'])->name('user.profile');
        });

        Route::prefix('/game')->group(function () {
            Route::get('/create/{game?}', [GameController::class, 'create'])->name('chess.game.create');
            Route::get('/show/{game}', [GameController::class, 'show'])->name('chess.game.show');
            Route::view('/history', 'chess.game.history')->name('chess.game.history');
            Route::get('/bet/{game}', [GameController::class, 'bet'])->name('chess.game.bet');
            Route::get('/ranking', [GameController::class, 'rankingchess'])->name('chess.game.ranking');
        });

        Route::prefix('/tournament')->group(function () {
            Route::view('/', 'chess.tournament.index')->name('chess.tournament.index');
            Route::get('/show/{tournament}', [TournamentController::class, 'show'])->name('chess.tournament.show');
            Route::get('/{tournament}', [TournamentController::class, 'edit'])->name('chess.tournament.edit');
        });
    });
    Route::prefix('/darts')->group(function () {

        Route::view('/dashboard', 'darts.dashboard')->name('darts.dashboard');

        Route::prefix('/game')->group(function () {
            Route::get('/ranking', [GameController::class, 'rankingdarts'])->name('darts.game.ranking');
        });
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin', 'admin.index')->name('admin.index');
});

Route::fallback(function () {
    return redirect('login');
});

require __DIR__ . '/auth.php';
