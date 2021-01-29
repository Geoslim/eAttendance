<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {

         
        if (Gate::allows('admin-only', auth()->user())) {
        return view('admin_profile');
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }

    public function update(Request $request)
    {

         
        if (Gate::allows('admin-only', auth()->user())) {
         $admin = User::find(Auth::User()->id);
        // dd($user);

        $this->validate($request, [
            'fullname' => 'required|string|min:7|max:225',
            'email' => 'required|string|email|max:255|unique:users,email,'. $admin->id,
            'mobile' => 'required|string|min:7|max:225',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($request->hasFile('profile_image')){

            $profile_image = $request->file('profile_image');
            $filename = time().'.'.$profile_image->getClientOriginalExtension(); 
            Image::make($profile_image)->fit(200, 200)->save(base_path('public/avatar/'. $filename));



                User::where('id', Auth::User()->id)->update([
                    'fullname' => $request->input('fullname'),
                    'email' => $request->input('email'),
                    'mobile' => $request->input('mobile'),
                    // 'designation_id' => $request->input('designation'),
                    // 'gender' => $request->input('gender'),                  
                    // 'member_since' => $request->input('member_since'),
                    'profile_image' => $filename,
                
                ]);
            }else {
                User::where('id',  Auth::User()->id)->update([
                    'fullname' => $request->input('fullname'),
                    'email' => $request->input('email'),
                    'mobile' => $request->input('mobile'),
                    // 'designation_id' => $request->input('designation'),
                    // 'gender' => $request->input('gender'),
                    // 'member_since' => $request->input('member_since'),
                    ]);
            }


// dd( Storage::disk('public')->url($url));
        alert()->success('Admin Details Updated successfully','Update Success' )->autoclose(10000);
        return back();
    }
    alert()->success('Welcome Back','Redirect');
    return redirect()->action('StaffController@index');
    }
}
