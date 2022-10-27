<?php

namespace App\Http\Controllers;

use App\Models\Tournois;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournoisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('tournois.new');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $name = $request->input('name');
        $cashPrize = $request->input('cashPrize');
        $cashPrizeModo = $request->input('cashPrizeModo');
        $notif = $request->input('notif');

        if ($notif){
            $notif = 0;
        }

        $newTournois = new Tournois();

        $newTournois->name = $name;
        $newTournois->cashprize_perso = $cashPrize;
        $newTournois->cashprize_modo = $cashPrizeModo;
        $newTournois->notification = $notif;
        $newTournois->user_id = Auth::id();
        $newTournois->save();

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
