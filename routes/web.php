<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-account',[\App\Http\Controllers\AccountController::class,'myaccount'])->name('my-account');

Route::get('/newTournois',[\App\Http\Controllers\TournoisController::class,'index'])->name('newTournois');

Route::get('/game-history',[GameHistoryController::class,'gameHistory'])
->name('gameHistory');
Route::get('/tournois/{id}',[\App\Http\Controllers\TournoisController::class,'show'])->name('tournois.show');


Route::get('/game/create')->name('game.create');


require __DIR__.'/auth.php';
