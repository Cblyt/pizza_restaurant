<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\TwoFactorAuthenticationEmail;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    public function show()
    {
        return view('twoFactor.index');
    }

    public function resend()
    {
        $user=auth()->user();
        $user->generateTwoFactorCode();
        Mail::to($user->email)->send(new TwoFactorAuthenticationEmail($user->email, $user->two_factor_code));
        return redirect()->back()->with('success','A new two factor code has been sent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => ['required'],
        ]);
        $user = auth()->user();

        if($request->two_factor_code == $user->two_factor_code) {
            $user->clearTwoFactorCode();

            return redirect()->route('welcome');
        }
        else {
            return redirect()->back()->withErrors(['two_factor_code' => 'The two factor is incorrect']);
        }
    }
}
