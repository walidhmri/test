<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::where('user_id', $request->id)->paginate(10);
        $solutions=Solution::where('user_id', $request->id)->paginate(10);
        $employee = User::find($request->id);
        return view('admin.profile.show', compact('employee', 'tickets', 'solutions'));
    }
    public function indexpass(Request $request)
    {
        $employee = User::find($request->id);
        return view('admin.profile.password', compact('employee'));
    }
    public function password(Request $request)
    {

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password confirmation does not match');
        }

        $request->validate([ 'password' => 'required|min:6']);
        $employee = User::find($request->id);
        if (!password_verify($request->current_password, $employee->password)) {
            return redirect()->back()->with('error', 'Current password does not match');
        }
        $employee->password = Hash::make($request->password);
        $employee->save();
        return redirect()->route('admin.profile.show', ['id' => $employee->id])->with('success', 'Password updated successfully');
    }

}
