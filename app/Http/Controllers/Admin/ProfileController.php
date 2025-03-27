<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teket;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Teket::where('user_id', $request->id)->get();
        $employee = User::find($request->id);

        return view('admin.profile.show', compact('employee', 'tickets'));
    }



}
