<?php

namespace App\Http\Controllers;

use App\Enums\GameResultEnum;
use App\Models\GamePlayer;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Game;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAccountRequest;

class UserController extends Controller
{
    public function getProfile($id)
    {
        $user = User::query()->where('id',$id)->first();

        return view('user.profile')->with([
            'userId' => $user->id,
            'userName' => $user->name
        ]);
    }
}
