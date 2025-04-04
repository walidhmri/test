<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::paginate(10);
        return view('admin.departments.list', compact('departments'));
    }
    function create(){
        return view('admin.departments.create');
    }
    function store(Request $request){
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'manager_id' => 'required|exists:users,id',
        ]);

        Department::create($data);

        return redirect()->route('admin.department.list')->with('success', 'Department created successfully.');
    }
    function edit(int $id){
        $department = Department::find($id);
        return view('admin.departments.edit', compact('department'));
    }
    function update(int $id, Request $request){
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'manager_id' => 'required|exists:users,id',
        ]);

        $department = Department::find($id);
        $department->update($data);

        return redirect()->route('admin.department.list')->with('success', 'Department updated successfully.');
    }  
    function destroy(Request $request){
        $department = Department::find($request->id);
        $department->delete();
        return redirect()->route('admin.department.list')->with('success', 'Department deleted successfully.');
    }

}
