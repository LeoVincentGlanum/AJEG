<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function getProfile(User $user): Factory|View|Application
    {
        return view('user.profile', ['user' => $user]);
    }
}
