<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

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
    return view('home');
});

Route::post('accounts',[AccountController::class, 'store'])
    ->name('accounts.store')
    ->middleware([HandlePrecognitiveRequests::class]);

