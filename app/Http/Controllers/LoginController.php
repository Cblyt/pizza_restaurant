<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginCheck(Request $request) 
    {
        if (!$this->verifyCapatcha($request)) {
            return back()->withErrors(['ReCaptcha Error']);
        };

        $this->validateLogin($request);
        $credentials = $request->only('email', 'password');

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return back()->withErrors(['You are locked out']);
        }

        // Successful login
        else if($this->attemptLogin($credentials)) {
            return view('welcome');
        }

        else {
            $this->countLoginAttempts($request);
            return back()->withErrors(['Incorrect credentials']);
        };
    }

    // Verify the Google capatcha
    public function verifyCapatcha(Request $request)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $data = [
                'secret' => config('services.recaptcha.secret'),
                'response' => $request->get('recaptcha'),
                'remoteip' => $remoteip
            ];

        $options = [
                'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
                ]
            ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success != true || $resultJson->score < 0.5) {
            return false;
        } else {
            return true;
        }
    }


    // Validate the login credentials
    public function validateLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    }

    // Log authenticated user out and redirect to the login page
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }

    public function changePasswordForm()
    {
        return view('changePassword');
    }

    public function changePassword(Request $request)
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
        else if($this->checKPasswordIsNew($request))
        {
            return back()->withErrors(['Please choose a different password to the current password']);
        }

        // Check that the password given results in a successful login
        $credentials = ['email' => Auth::User()->email, 'password' => $request['password']];
        if(!$this->attemptLogin($credentials))
        {
            return back()->withErrors(['Wrong password!']);          
        }
        
        else
        {
        Auth::user()->password = Hash::make($request['newpassword']);
        Auth::user()->save();
        return view('welcome');  
        } 
    }

    public function attemptLogin($credentials)
    {
        return Auth::attempt($credentials);
    }

    public function confirmPassword($request)
    {
        return ($request['newpassword'] != $request['confnewpassword']);
    }

    public function checkPasswordIsNew($request)
    {
        return ($request['password'] == $request['newpassword']);
    }


    /*
    Limit invalid login attempts
    */


    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    protected function countLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->lockoutTime() * 60
        );
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    public function maxAttempts()
    {
        return 5;
    }

    public function lockoutTime()
    {
        return 10;
    }
}