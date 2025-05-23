<?php

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Session;
class UserController extends Controller
{
    public function index(){
        $tickets = Ticket::where('user_id', auth()->user()->id)
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
            'localization'=>$request->locale,
            'password' => $request->password ? bcrypt($request->password) : Auth::user()->password,
        ]);
        App::setlocale($request->locale);
        Session::put('locale', $request->locale);

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
