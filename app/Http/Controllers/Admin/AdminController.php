<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        $employees = User::get();
        return view('admin.dashboard', compact('employees', 'tickets'));
    }
    function employee(Request $request)
    {
        $search = $request->input('search');

        $employees = User::whereIn('role', ['user', 'admin'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('role', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.employee.list', compact('employees'));
    }

    function ingenieur(Request $request)
    {
        $search = $request->input('search');

        $employees = User::where('role', 'ingenieur')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); 

        return view('admin.ingenieur.list', compact('employees'));
    }


    function addEmployee()
    {
        $departments=Department::all();
        return view('admin.employee.ajouter',compact('departments'));
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


        return redirect()->route('admin.employee.list')->with('success', 'تمت إضافة المستخدم بنجاح.');
    }
    function deleteEmployee(Request $request)
    {

        $employee = User::find($request->id);
        if (!$employee) {
            return redirect()->route('admin.employee.list')->with('error', 'User not found');
        }
        $employee->delete();

        return redirect()->back()->with('success', 'User deleted succeffully');

    }
    function editEmployee(Request $request)
    {
        $employee = User::find($request->id);
        $departments= Department::all();

        return view('admin.employee.edit', compact('employee','departments'));
    }
    function updateEmployee(Request $request)
    {
        $employee = User::find($request->id);
        if (!$employee) {
            return redirect()->route('admin.employee.list')->with('error', 'User not found');
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'max:255'],
            'role' => ['required', 'in:admin,ingenieur,user'], 
            'department_id' => ['required', 'exists:departments,id'],
        ]);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department_id'=>$request->department_id,
        ]);
        return redirect()->route('admin.profile.show', ['id' => $employee->id])->with('success', 'Profile modifier avec succées');


    }

}

