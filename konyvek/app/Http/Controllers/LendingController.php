<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $lending = response()->json(Lending::all());
        return $lending;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
    }

    /**
     * Display the specified resource.
     */
    public function show ($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->
        where('copy_id', $copy_id)->
        where('start', $start)->get();
        return $lending[0];
    }


    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, $user_id, $copy_id, $start)
    {
        $lending = $this->show($user_id, $copy_id, $start);
 
    }*/ /*egyenlőre ennek nincs értelme 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id,$copy_id, $start)
    {
        Lending::where('user_id', $user_id)->
                where('copy_id', $copy_id)->
                where('start',$start)->delete();
    }

    public function allLendingByUserCopy(){
        // a modellben megírt függvények neveit használom
        $datas = Lending::with(['copies', 'users'])
        ->get();
        return $datas;
    }

    public function dateLendingUserCopy(){
        $dates = Lending::with(['copies', 'users'])
        ->where('start','=', '1983-09-12')
        ->get();
        return $dates;
    }

    public function idLendingUserCopy($copy_id){
        $books = Lending::with(['copies', 'users'])
        ->where('copy_id', $copy_id)
        ->get();
        return $books;
    }

    public function oneidLendingUserCopy(){
        $user = Auth::user();
        $oneid = Lending::with(['copies', 'users'])
        ->where('user_id','=',$user->id)
        ->count();
        return $oneid;
    }

    
}
