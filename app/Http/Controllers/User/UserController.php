<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ticket;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){
        $tickets = ticket::where('user_id', auth()->user()->id)
        ->orderBy('id','desc')
        ->get();
        return view('employee.dashboard', compact('tickets'));
    }
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
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
    
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        return redirect()->route('employee.profile.edit')->with('success', 'Password updated successfully!');
    }
    
}
