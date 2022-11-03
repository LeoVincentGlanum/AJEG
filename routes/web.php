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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
//    $games = \App\Models\GamePlayer::query()->where('user_id','=', Auth::id())->with('game')->where('status','!=','end')->get();
    $games = Game::with('users');
    $games->whereHas('gamePlayers', function ($query) {
        $query->where('user_id', Auth::id());
    })->where('status', '!=', 'end')->get();

    return view('dashboard')->with(['games' => $games]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-account', [\App\Http\Controllers\AccountController::class, 'myaccount'])->name('my-account');

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
