<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Attendance;
use App\Staff;
use SweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class DashboardController extends Controller
{
    public function index()
    {
    if (Gate::allows('admin-only', auth()->user())) {
        $staff = User::where('role',"2")->get();
        $sign_in_attendance = Attendance::where('status', "Signed In")->get();
        $sign_out_attendance = Attendance::where('status', "Signed Out")->get();
        return view('dashboard')
        ->with('staff',$staff)
        ->with('sign_in_attendance',$sign_in_attendance)
        ->with('sign_out_attendance',$sign_out_attendance);
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }
    
    public function allStaff()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            
            $all_staff = Staff::where('role', "2")->get();
        return view('all-staff')->with('all_staff', $all_staff);
        }
        alert()->success('Welcome Back','Redirect');
        return redirect()->action('StaffController@index');
        
    }

    public function addStaff()
    {
        if (Gate::allows('admin-only', auth()->user())) {
        return view('add-staff');
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }

    public function storeStaff(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|string|min:7|max:225',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|min:7|max:225',
            'designation' => 'required|string|min:7|max:225',
            'dept' => 'required|string|min:7|max:225',
            
        ]);
        $new_staff = new User;
        $new_staff->fullname = $request->input('fullname');
        $new_staff->email = $request->input('email');
        $new_staff->mobile = $request->input('mobile');
        $new_staff->dept = $request->input('dept');
        $new_staff->role = "2";
        $password = "1234567890";
        $new_staff->password = Hash::make($password);
        $new_staff->status = "Signed Out";
        $new_staff->designation = $request->input('designation');
        
        $new_staff->save();
        alert()->success('Staff Added successfully','Entry Success' )->autoclose(10000);
        return redirect()->action('StaffController@index');
    }

    public function genAttend()
    {
        if (Gate::allows('admin-only', auth()->user())) {
        
        $attendance = Attendance::all();
        return view('general-attendance')->with('attendance', $attendance);
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }
}
