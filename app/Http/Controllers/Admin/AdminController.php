<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teket;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    function index(){
        $tickets = Teket::orderBy('created_at','desc')->get();
        $employees = User::get();
        return view('admin.dashboard',compact('employees', 'tickets'));
    }
    function employee(Request $request){

        $search = $request->input('search'); // Get the search parameter
        $employees = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('role', 'LIKE', "%{$search}%");
        })->orderBy('created_at','desc')->paginate(10); // Use pagination
        return view('admin.employee.list',compact('employees'));
    }
    function ingenieur(){
        $employees = User::where('role', 'ingenieur')->paginate(10);
        return view('admin.ingenieur.list',compact('employees'));
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


        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // عدم تسجيل دخول المستخدم لأنه يتم إنشاؤه من قبل **الإداري**

        return redirect()->route('admin.employee.list')->with('success', 'تمت إضافة المستخدم بنجاح.');
    }
    function deleteEmployee(Request $request){

        $employee = User::find($request->id);
        if (!$employee) {
            return redirect()->route('admin.employee.list')->with('error', 'User not found');
        }
        $employee->delete();

        return redirect()->back()->with('success', 'User deleted succeffully');

    }
    function editEmployee(Request $request){
        $employee = User::find($request->id);
  
        return view('admin.employee.edit',compact('employee'));
    }
    function updateEmployee(Request $request){
        $employee = User::find($request->id);
        if (!$employee) {
            return redirect()->route('admin.employee.list')->with('error', 'User not found');
        }
        if($employee->role == 'admin'){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'max:255'],
                'role' => ['required', 'in:admin,ingenieur,user'], 
                'password' => ['required']
            ]);
            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back('admin.profile.show',['id' => $employee->id])->with('success', 'Profile modifier avec succées');
        }


        
        else{
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'max:255'],
            'role' => ['required', 'in:admin,ingenieur,user'], // التأكد من صحة الدور
        ]);
        
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        return redirect()->back()->with('success', 'User updated succeffully');
    }
    
    }
    
}

