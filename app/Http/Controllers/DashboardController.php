<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Attendance;
use App\StepInOut;
use App\Staff;
use App\Designation;
use SweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
    
    public function allEmployees()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            
            $all_staff = User::where('role', "2")->get();

        return view('employees.all-employee')->with('all_staff', $all_staff);
        }
        alert()->success('Welcome Back','Redirect');
        return redirect()->action('StaffController@index');
        
    }

    public function addEmployee()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            $designations = Designation::get();
            return view('employees.add-employee')->with('designations',$designations);
        }
        alert()->success('Welcome Back','Redirect');
        return redirect()->action('StaffController@index');
    }

    public function storeEmployee(Request $request)
    {
        // dd($request->all());
    //   dd( $image = $request->profile_image->store('uploads'));
        $this->validate($request, [
            'fullname' => 'required|string|min:7|max:225',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|min:7|max:225',
            'designation' => 'required',
            'gender' => 'required',
            'member_since' => 'required',
            'profile_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($request->hasFile('profile_image')){
        //     // get filename with the extension
        //     $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
        //     //get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     //GET NUST EXT
        //     $extension = $request->file('profile_image')->getClientOriginalExtension();
        //     //filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     //upload the image
        //     $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);
            
        
        // $profile_image = $request->file('profile_image');
        // $ext = $profile_image->getClientOriginalExtension();
        // $image_resize = Image::make($profile_image->getRealPath());
        // $resize = Image::make($image_resize)->fit(100, 100)->encode($ext);
        // $hash = md5($resize->__toString());
        // $path = "{$hash}.$ext";
        // $url = 'employees/'.$path; 
        // // dd($url);
        // Storage::put($url, $resize->__toString());
        $imagePath = request('profile_image')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(200, 200);
            $image->save();
        }
        $new_employee = new User;
        $new_employee->fullname = $request->input('fullname');
        $new_employee->email = $request->input('email');
        $new_employee->mobile = $request->input('mobile');
        $new_employee->gender = $request->input('gender');
        $new_employee->member_since = $request->input('member_since');
        $new_employee->role = "2";
        $password = "1234567890";
        $new_employee->password = Hash::make($password);
        $new_employee->status = "Signed Out";
        $new_employee->profile_image = $imagePath;
        $new_employee->designation_id = $request->input('designation');
        
        $new_employee->save();
        alert()->success('Employee Added successfully','Entry Success' )->autoclose(10000);
        return redirect()->action('DashboardController@allEmployees');
    }


    public function viewEmployee($id)
    {
        if (Gate::allows('admin-only', auth()->user())) {
        
        $view_employee = User::findOrFail($id);
        $attendance = Attendance::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        $stepped_out = StepInOut::where('user_id',$id)->where('status','0')->first();
        $stepped_out_details = StepInOut::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(2);

        return view('employees.view-employee')
        ->with('view_employee', $view_employee)
        ->with('attendance', $attendance)
        ->with('stepped_out',$stepped_out)
        ->with('stepped_out_details',$stepped_out_details);

    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }


    public function hrApprove(Request $request, $id)
    {
        // dd($request->all());
        $hr_approval = $request->input('hr_approve');
        $signed = "Signed Out";
        if (Gate::allows('admin-only', auth()->user())) {
        
            User::where('id', $id)->update([
                'hr_approve' => $hr_approval,
                'status' => $signed
            
            ]);
            alert()->success('Approved to Sign In Successfully','Update Success' )->autoclose(10000);
            return redirect()->back();
    }
    alert()->success('Welcome Back','Redirect');
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

    public function deleteEmployee(Staff $employee) 
    {
        // dd($employee->name);
            $employee->delete();
    
            alert()->success('Employee deleted successfully','Success');
            return redirect()->action('DashboardController@allEmployees');
     
    }
}
