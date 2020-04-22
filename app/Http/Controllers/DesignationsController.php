<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Designation;
use SweetAlert;

class DesignationsController extends Controller
{
    public function index()
    {
    if (Gate::allows('admin-only', auth()->user())) {
        $designations = Designation::get();
        return view('designation.index')
        ->with('designations',$designations);
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }
    
    public function storeDesignation(Request $request)
    {
        if (Gate::allows('admin-only', auth()->user())) {
        $this->validate($request, [
            'title' => 'required|string|min:2|max:225',
            'time_in' => 'required|string|min:2|max:255',
            'time_out' => 'required|string|min:2|max:225',
            'lateness_benchmark' => 'required|string|min:2|max:225',
            
            
        ]);
        $new_designation = new Designation;
        $new_designation->title = $request->input('title'); 
        $new_designation->time_in = $request->input('time_in');
        $new_designation->time_out = $request->input('time_out');
        $new_designation->lateness_benchmark = $request->input('lateness_benchmark');
        
        $new_designation->save();
        alert()->success('Designation Added successfully','Entry Success' )->autoclose(10000);
        return redirect()->back();
    
        }
        alert()->success('Welcome Back','Redirect');
        return redirect()->action('StaffController@index');
        }

    public function edit($id)
    {
        if (Gate::allows('admin-only', auth()->user())) {
            $designations = Designation::get();
            $designation_edit = Designation::find($id);

            return view('designation.index')
            ->with('designations',$designations)
            ->with('designation_edit',$designation_edit);
        }
    }

    public function updateDesignation(Request $request, $id)
    {
        if (Gate::allows('admin-only', auth()->user())) {
        $this->validate($request, [
            'title' => 'required|string|min:2|max:225',
            'time_in' => 'required|string|min:2|max:255',
            'time_out' => 'required|string|min:2|max:225',
            'lateness_benchmark' => 'required|string|min:2|max:225',
            
            
        ]);

        Designation::where('id',$id)->update([
            'title' => $request->input('title'),
            'time_in' => $request->input('time_in'),
            'time_out' => $request->input('time_out'),
            'lateness_benchmark' => $request->input('lateness_benchmark'),
        
        ]);
        alert()->success('Designation Updated successfully','Entry Success' )->autoclose(10000);
        return redirect()->back();
    
        }
        alert()->success('Welcome Back','Redirect');
        return redirect()->action('StaffController@index');
        }
}
