<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Incharge;
use DB;
use Session;

class AdminController extends Controller
{

    public function Department(Request $request)
    {
        $department = Department::all();
        $data['department'] = DB::table('department')->get();
        return view('department',compact('department'),$data);
    }

    public function insertDepartment(Request $request)
    {
        $department = new Department();
        
        $department->dept_name = $request->input('dept_name');
        $department->save();
        if ($department) {
            Session::put('department',$department);
            return redirect('/department')->with('status',"Department Added Successfully");            
        }
    }

    public function editDepartment($id)
    {
        $department = Department::find($id);
        return view('edit-department',compact('department','id'));
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::find($id);
        $department->dept_name = request('dept_name');
        $department->save();
       
        return json_encode(array('statusCode'=>200));
    }

    public function destroyDepartment($id)
    {
        $department = Department::find($id);
        
        $department->delete();
        return redirect('/department')->with('status',"Department Deleted Successfully");
    }

}
