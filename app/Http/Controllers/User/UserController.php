<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function editProfile()
    {
        return view('employee.edit');
    }
    function Profile(){
        return view('employee.profile');
        
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required'
            
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : Auth::user()->password,
        ]);

        return redirect()->route('employee.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
