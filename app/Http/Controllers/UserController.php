<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function getProfile($id): Factory|View|Application
    {
        $user = User::query()->where('id',$id)->first();

        return view('user.profile')->with([
            'user' => $user
        ]);
    }
}
