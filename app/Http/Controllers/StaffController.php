<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Staff;
use App\StepInOut;
use App\Attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Gate;
use SweetAlert;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class StaffController extends Controller
{
    

    public function index()
    {
        if (Gate::allows('staff-only', auth()->user())) {

        $staff_details = User::where('id',auth()->user()->id)->get();
        $staff_attendance = Attendance::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(6);;
        $stepped_out = StepInOut::where('user_id',auth()->user()->id)->where('status','0')->first();
        $stepped_out_details = StepInOut::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(2);;

        return view('staff-dashboard')
        ->with('staff_details',$staff_details)
        ->with('staff_attendance',$staff_attendance)
        ->with('stepped_out',$stepped_out)
        ->with('stepped_out_details',$stepped_out_details);

    }

    alert()->success('Welcome Back','Redirect');
    return redirect(url('dashboard'));
    
    }

    public function updateStaffStatus(Request $request, $id)
    {
        $find_status = User::where('id',auth()->user()->id)->first();
        $status = $request->input('status');
        $current = Carbon::now();
        $another = Carbon::now();
            // $sign_in_threshold = $current->addDay(1)->hour(0)->minute(0)->second(0);

        // dd($current->addDay(1)->hour(0)->minute(0)->second(0));
        
        // dd(  Carbon::now() > $current->addMinutes(2));
        // dd( $current >  $find_status->designation->lateness_benchmark);
        // dd(  Carbon::now() > $find_status->banned_until);
        // !empty($find_status->banned_until) 
        if($status == "on"){
            $signed = "Signed In";
            $ban_time = $current->addMinutes(1);
            $sign_in_threshold = $another->addDay(1)->hour(0)->minute(0)->second(0)->toDateTimeString();
            $hr_approve = 0;
        }elseif($status != "on"){
            $signed = "Signed Out";
            $ban_time = $current->addMinutes(1);
            $hr_approve = 1;
            $sign_in_threshold = $another->addDay(1)->hour(0)->minute(0)->second(0)->toDateTimeString();
            // $add_start_time_stamp = $current->addYear(0)->addMonth(0)->addDay(1)->hour(0)->minute(0)->second(0)->toDateTimeString();
            // dd($add_start_time_stamp );
        }
        if($signed === $find_status->status){
            alert()->error(auth()->user()->fullname.', is '. $signed .' already','Validation Update' )->autoclose(10000);
            return redirect()->action('StaffController@index');
        }
    //    elseif ($find_status->status == "Signed In" && Carbon::now() < $find_status->ban_time) {
    //     alert()->error('Hello '.auth()->user()->fullname.', it\'s too early to Sign Out','Validation Update' )->autoclose(10000);
    //     return redirect()->action('StaffController@index');
    //    }
    //    elseif ($find_status->status == "Signed Out" && Carbon::now() < $find_status->ban_time ) {
    //     alert()->error('Hello '.auth()->user()->fullname.', That\'s all for today.','Validation Update' )->autoclose(10000);
    //     return redirect()->action('StaffController@index');
    //    }
         elseif ($find_status->status == "Signed In" && Carbon::now() > $find_status->sign_in_threshold ) {
            alert()->error('Hello '.auth()->user()->fullname.', Forgot to sign out yesterday? Kindly meet HR to get cleared.','Validation Update' )->autoclose(10000);
            return redirect()->action('StaffController@index');
           }
        else{
          
        $new_attendance = new Attendance;
        $new_attendance->user_id = auth()->user()->id;
        $new_attendance->fullname = auth()->user()->fullname;
        $new_attendance->email = auth()->user()->email;
        $new_attendance->status = $signed;
        
        $new_attendance->save();

        User::where('id', auth()->user()->id)->update([
            'status' => $signed,
            'ban_time' => $ban_time,
            'hr_approve' => $hr_approve,
            'sign_in_threshold' => $sign_in_threshold,
        ]);
        if ($signed === "Signed In" && $current >  $find_status->designation->lateness_benchmark) {
            $late = $current->diffForHumans($find_status->designation->lateness_benchmark, CarbonInterface::DIFF_ABSOLUTE);
            alert()->success(auth()->user()->fullname.', '. $signed .'. - You\'re '. $late. ' late','Update Success' )->autoclose(10000);
            return redirect()->action('StaffController@index');
        }
        else{
            alert()->success(auth()->user()->fullname.', '. $signed .' successfully','Update Success' )->autoclose(10000);
            return redirect()->action('StaffController@index');
        }
       
        }
    }

    
}
