<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register.index');
    }

    protected function store(Request $request)
    {
        $userdata = $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users'],
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
            return redirect()->route('login.show');
        } 
        else {
            return back()->withErrors(['Passwords do not match']);
        }
    }

    public function sendVerificationEmail(Request $request)
    {
        $user=auth()->user();
        $user->generateVerificationHash();
        Mail::to($user->email)->send(new VerificationEmail($user->email, $user->hash));
        return redirect()->route('email_verification.index');
    }
}
