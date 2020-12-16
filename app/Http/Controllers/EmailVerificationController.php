<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('email_verification.index');
    }

    public function store(Request $request)
    {
        $user=User::get()->where('email',$request['email'])->first();

        if($user->hash==$request['hash'] || $user->active==True)
        {
            $user->active = True;
            $user->save();
            return redirect()->route('login.show')->withMessage('Your email has been verified!');
        }
        else
        {
            return redirect()->back()->withErrors('Email verification failed');
        }
    }

    public function resend()
    {
        $user=auth()->user();
        $user->hash = md5(rand(0,1000));
        $user->save();
        Mail::to($user->email)->send(new VerificationEmail($user->email, $user->hash));
        return redirect()->back()->withMessage(['new_verification_email_send'=> 'A new verification email has been sent to your email']);
    }
}
