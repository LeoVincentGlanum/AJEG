<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAccountRequest  $request
     *
     * @return void
     */
    public function store(StoreAccountRequest $request)
    {
        $pseudo       = $request->input('pseudo');
        $password     = $request->input('password');
        $confpassword = $request->input('confpassword');

        $validated = $request->validated();

        $user = new User();
        $user->pseudo = $pseudo;
        $user->password = $password;
        $user->save();

       return  redirect()->back();
    }

}
