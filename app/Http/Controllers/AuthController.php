<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Instructor\Instructor;
use App\Models\Member\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginAdminShow(request $request,response $response){
           // print_r('sssss');
            //exit();
            return view('Auth.Newlogin');
    }
   
    public function loginMember(request $request,response $response)
    {
        
        $request->validate([
            'phone_no'   => 'required',
            'pin'        => 'required',
        ]);
       
        $member = Member::where('phone_no', $request->phone_no)->first();

       $credentials = $request->only('phone_no', 'pin');   
       
        if ($member && Hash::check($credentials['pin'], $member->pin)) {
            
           Auth::guard('member')->login($member);
            return redirect()->intended('member/dashboard');
        }
       
        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['msg' => 'Invalid credentials.']);
    }
    public function loginInstructor(request $request,response $response)
    {
        $request->validate([
            'phone_no'   => 'required',
            'pin'        => 'required',
        ]);

        // Attempt to authenticate using phone number and password
        $instructor = Instructor::where('phone_no', $request->phone_no)->first();

        if ($member && Hash::check($credentials['pin'], $member->pin)) {
            
            Auth::guard('instructor')->login($instructor);
            return redirect()->intended('instructor/dashboard');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['msg' => 'Invalid credentials.']);
    }
    public function loginAdmin(request $request,response $response)
    {
        $request->validate([
            'name'      => 'required',
            'password'  => 'required',
        ]);

        // Attempt to authenticate using phone number and password
        $user = User::where('name', $request->name)->where('password', $request->password)->first();

        if ($user ) {
            Auth::login($user);
            return redirect()->intended('admin/dashboard');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['msg' => 'Invalid credentials.']);
       
    }
    public function logoutAdmin(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect to the login page or home page
        return redirect('/');
    }
    
    
}