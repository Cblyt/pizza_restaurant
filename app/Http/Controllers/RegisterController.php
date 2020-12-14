<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    protected function registerCheck(Request $request)
    {
        $userdata = $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'email' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'address_houseno' => ['required', 'string'],
            'address_streetname' => ['required', 'string'],
            'address_postcode' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'confpassword' => ['required', 'string', 'min:8'],
        ]);
        
        if($userdata['password'] == $userdata['confpassword']) {
            User::create([
                'first_name' => $userdata['fname'],
                'last_name' => $userdata['lname'],
                'email' => $userdata['email'],
                'date_of_birth' => $userdata['dob'],
                'address_houseno' => $userdata['address_houseno'],
                'address_streetname' => $userdata['address_streetname'],
                'address_postcode' => $userdata['address_postcode'],
                'password' => Hash::make($userdata['password']),
            ]);
            $this->sendVerificationEmail($request);
            return redirect()->route('loginForm');
        } 
        else {
            return back()->withErrors(['Passwords do not match']);
        }
    }

    public function sendVerificationEmail(Request $request)
    {
        $user = User::get()->where('email', $request['email'])->first();
        if($user!=null) {

            $user->hash = md5(rand(0,1000));
            $user->save();
            $to = $request['email'];
            Mail::to($to)->send(new VerificationEmail($to, $user->hash));
        }
        else
        {
            return back()->withErrors(['This email is not registered']);
        }
        return redirect()->route('loginForm');
    }
}
