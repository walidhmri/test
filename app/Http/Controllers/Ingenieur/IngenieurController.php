<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IngenieurController extends Controller
{
    function index()
    {
        return view('ingenieur.dashboard');
    }

    function store(Request $request){

    }
    function update(Request $request){

    }
    function destroy(Request $request){

    }
}
