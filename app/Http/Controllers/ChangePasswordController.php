<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('change_password.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'newpassword' => ['required', 'string', 'min:8'],
            'confnewpassword' => ['required', 'string', 'min:8'],
        ]);
        
        // Check the confirm new password field is the same as the new password.
        if($this->confirmPassword($request))
        {
            return back()->withErrors(['The new password does not match the confirmation']);
        }

        // Check the new password is different to the original password
        else if($this->checkPasswordIsNew($request))
        {
            return back()->withErrors(['Please choose a different password to the current password']);
        }

        // Check that the password given results in a successful login
        $user = auth()->user();
        $credentials = ['email' => $user->email, 'password' => $request['password']];
        if(!$user->attemptLogin($credentials))
        {
            return back()->withErrors(['Wrong password!']);          
        }
        
        else
        {
        Auth::user()->password = Hash::make($request['newpassword']);
        Auth::user()->save();
        return redirect()->route('welcome');  
        } 
    }

    public function confirmPassword($request)
    {
        return ($request['newpassword'] != $request['confnewpassword']);
    }

    public function checkPasswordIsNew($request)
    {
        return ($request['password'] == $request['newpassword']);
    }
}
