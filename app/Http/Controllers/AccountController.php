<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAccountRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAccountRequest $request)
    {
        $pseudo       = $request->input('pseudo');
        $password     = $request->input('password');
        $confpassword = $request->input('confpassword');



        $user = new User();
        $user->pseudo = $pseudo;
        $user->password = Hash::make($password);
        $user->save();

       return  redirect()->back();
    }

    public function login(){
        return view('dashboard');
    }

    public function myaccount(){
        return "ajdaojf";
    }
}
