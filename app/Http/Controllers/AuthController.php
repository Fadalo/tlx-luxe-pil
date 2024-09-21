<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginAdmin(request $request,response $response)
    {
       

        $request->validate([
            'name' => 'required',
            'password'     => 'required',
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