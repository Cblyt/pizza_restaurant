<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::get()->where('email',$request['email'])->first();
        if($user!=null) {
            if($user->hash==$request['hash'] || $user->active==True)
            {
                $user->active = True;
                $user->save();
                return redirect()->route('loginForm')->with('note', 'Your email has been verified!');
            }
        }
        return view('verification-fail')->with('request',$request);
    }
}
