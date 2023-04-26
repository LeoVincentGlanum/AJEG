<?php

use App\Http\Controllers\TournamentChessController;
use App\Http\Controllers\TournamentDartsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameChessController;
use App\Http\Controllers\GameDartsController;
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

        Route::prefix('/game')->group(function () {
            Route::view('/dashboard', 'chess.game.dashboard')->name('chess.game.dashboard');
            Route::view('/create', 'chess.game.create')->name('chess.game.create');
//            Route::get('/create/{game?}', [GameChessController::class, 'create'])->name('chess.game.create');
//            Route::get('/show/{game}', [GameChessController::class, 'show'])->name('chess.game.show-chess');
//            Route::view('/history', 'chess.game.history-chess')->name('chess.game.history-chess');
//            Route::get('/bet/{game}', [GameChessController::class, 'bet'])->name('chess.game.bet');
//            Route::get('/ranking', [GameChessController::class, 'ranking'])->name('chess.game.ranking');
        });

        Route::prefix('/tournament')->group(function () {
            Route::view('/', 'chess.tournament.index-chess')->name('chess.tournament.index-chess');
            Route::get('/show/{tournament}', [TournamentChessController::class, 'show'])->name('chess.tournament.show-chess');
            Route::get('/{tournament}', [TournamentChessController::class, 'edit'])->name('chess.tournament.edit-chess');
        });
    });

    Route::prefix('/darts')->group(function () {
        Route::view('/dashboard', 'darts.dashboard')->name('darts.dashboard');
        Route::view('/online-game', 'darts.online-game')->name('darts.online-game');

        Route::prefix('/game')->group(function () {
            Route::get('/create/{game?}', [GameDartsController::class, 'create'])->name('darts.game.create');
            Route::get('/show/{game}', [GameDartsController::class, 'show'])->name('darts.game.show-darts');
            Route::view('/history', 'darts.game.history-darts')->name('darts.game.history-darts');
            Route::get('/bet/{game}', [GameDartsController::class, 'bet'])->name('darts.game.bet');
            Route::get('/ranking', [GameDartsController::class, 'ranking'])->name('darts.game.ranking');
        });

        Route::prefix('/tournament')->group(function () {
            Route::view('/', 'darts.tournament.index-darts')->name('darts.tournament.index-darts');
            Route::get('/show/{tournament}', [TournamentDartsController::class, 'show'])->name('darts.tournament.show-darts');
            Route::get('/{tournament}', [TournamentDartsController::class, 'edit'])->name('darts.tournament.edit-darts');
        });
    });

    Route::prefix('/user')->group(function () {
        Route::view('/my-account', 'user.account')->name('user.my-account');
        Route::get('/profile/{user}', [UserController::class, 'getProfile'])->name('user.profile');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin', 'admin.index')->name('admin.index');
});

Route::fallback(function () {
    return redirect('login');
});

require __DIR__ . '/auth.php';
