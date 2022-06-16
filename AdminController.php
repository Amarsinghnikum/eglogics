<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Incharge;
use DB;
use Session;

class AdminController extends Controller
{
    public function RegisterPage(Request $request)
    {
        return view('register');
    }

    public function Register(Request $request)
    {

        $ParamArray = [
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        'password'=>$request->confirmpassword,
        ];

        $userregister = DB::table('users')->insert($ParamArray);
        if($userregister=1){
        return redirect('/login')->with('Admin Registered Successfully!');
        }
    }

    public function Login(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $usersession = DB::table('users')->where('email', $email)->where('password', $password)->first();
        if ($usersession) {
          Session::put('usersession',$usersession);
          echo "<h2>Login Successfully</h2>";  
          return redirect('/dashboard');            
        }
        else
        {
          return view('login');
        }
    }

    public function deleteUserProfile(Request $request)
    {
        $request->session()->forget('usersession');
        return redirect('/login');   
    }

    public function Dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function Department(Request $request)
    {
        $admin_id = Session::get('usersession')->id;
        $department = Department::all();
        $data['department'] = DB::table('department')->get();
        return view('department',compact('department'),$data);
    }

    public function insertDepartment(Request $request)
    {
        $admin_id = Session::get('usersession')->id;
        $department = new Department();
        
        $department->admin_id = $admin_id;
        $department->dept_name = $request->input('dept_name');
        $department->save();
        if ($department) {
            Session::put('department',$department);
            return redirect('/department')->with('status',"Department Added Successfully");            
        }
    }

    public function AddIncharge(Request $request)
    {
        $dept_id = Session::get('usersession')->id;
        $incharge = Incharge::all();
        $data['incharge'] = DB::table('section_incharge')->get();
        return view('incharge',compact('incharge'),$data);
    }

    public function insertIncharge(Request $request)
    {
        $dept_id = Session::get('department')->id;
        $incharge = new Incharge();
        
        $incharge->dept_id = $dept_id;
        $incharge->incharge_name = $request->input('incharge_name');
        $incharge->email = $request->input('email');
        $incharge->password = $request->input('password');
        $incharge->save();
        return redirect('/incharge')->with('status',"Section Incharge Added Successfully");
    }

    public function editDepartment($id)
    {
        $department = Department::find($id);
        return view('edit-department',compact('department'));
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::find($id);
       
        $department->dept_name = $request->input('dept_name');
        $department->update();
        return redirect('/department')->with('status',"Department Updated Successfully");
    }

    public function destroyDepartment($id)
    {
        $department = Department::find($id);
        
        $department->delete();
        return redirect('/department')->with('status',"Department Deleted Successfully");
    }

    public function editIncharge($id)
    {
        $incharge = Incharge::find($id);
        return view('edit-incharge',compact('incharge'));
    }

    public function updateIncharge(Request $request, $id)
    {
        $incharge = Incharge::find($id);
       
        $incharge->incharge_name = $request->input('incharge_name');
        $incharge->email = $request->input('email');
        $incharge->password = $request->input('password');
        $incharge->update();
        return redirect('/incharge')->with('status',"Incharge Updated Successfully");
    }

    public function destroyIncharge($id)
    {
        $incharge = Incharge::find($id);
        
        $incharge->delete();
        return redirect('/incharge')->with('status',"Incharge Deleted Successfully");
    }

}
