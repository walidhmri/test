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
    function create()
    {
        return view('ingenieur.create');
    }
    function store(Request $request){

    }
}
