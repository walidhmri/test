<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use App\Models\Teket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function index()

    {
        $employee = Auth::getUser();
        $ticket= Teket::where('user_id',$employee->id)->get();
        return view('ingenieur.profile',compact('employee','ticket'));
    }
    function store(Request $request){

    }
    function update(){
        $employee = Auth::getUser();
        return view('ingenieur.settings',compact('employee'));
    }
    function destroy(Request $request){

    }
}
