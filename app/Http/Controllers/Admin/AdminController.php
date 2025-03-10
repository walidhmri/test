<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class AdminController extends Controller
{
    function index(){
        return view('admin.dashboard');
    }
    function employee(){
        $employees = User::whereIn('role', ['user', 'ingenieur', 'admin'])->get();
        return view('admin.employee.list',compact('employees'));
    }
    function addEmployee(){
        return view('admin.employee.ajouter');
    }
    public function storeEmployee(Request $request): RedirectResponse
    {
        
        
        $employee = User::where('email', $request->input('email'))->first();

if ($employee) {
    return redirect()->back()->with('error', 'المستخدم موجود بالفعل.');
}
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,ingenieur,user'], // التأكد من صحة الدور
        ]);
    

        // إنشاء المستخد
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // حفظ الدور المحدد
        ]);
        
        // إطلاق حدث التسجيل (اختياري إذا كنت تستخدم أحداث تسجيل Laravel)
        event(new Registered($user));
    
        // عدم تسجيل دخول المستخدم لأنه يتم إنشاؤه من قبل **الإداري**
        
        // إعادة التوجيه إلى قائمة الموظفين بعد النجاح
        return redirect()->route('admin.employee.list')->with('success', 'تمت إضافة المستخدم بنجاح.');
    } 
}

