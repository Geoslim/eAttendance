<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Attendance;
use App\StepInOut;
use SweetAlert;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

class StepInOutController extends Controller
{
    public function stepOut(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'reason' => 'required|string|min:7|max:225',
            'user_id' => '',
            'status' => '',
           
        ]);

        $step_out = new StepInOut;
        $step_out->user_id =  $request->user_id;
        $step_out->reason =  $request->reason;
        $step_out->status = $request->status;
       
        // dd($step_out->user_id);
        
        $step_out->save();

        alert()->success(auth()->user()->fullname.', stepped out','Update Success' )->autoclose(10000);
        return redirect()->action('StaffController@index');
    }
    
    public function stepIn(Request $request, $id)
    {
        // dd($request->status);
        StepInOut::where('user_id', auth()->user()->id)->update([
            'status' => $request->status,
            
        ]);
        alert()->success('Welcome Back to the Office','Update Success' )->autoclose(10000);
        return redirect()->action('StaffController@index');
    }
}
