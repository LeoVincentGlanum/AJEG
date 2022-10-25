<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAccountRequest;

class GameHistoryController extends Controller
{
    public function gameHistory(){
        return view('gameHistory');
    }
}
