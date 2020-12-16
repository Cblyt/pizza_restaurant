<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\TwoFactorAuthenticationEmail;

class LoginController extends Controller
{
    public function show()
    {
        return view('login.index');
    }

    public function store(Request $request) 
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
            $user = auth()->user();
            $user->generateTwoFactorCode();
            $to = $request['email'];
            Mail::to($to)->send(new TwoFactorAuthenticationEmail($to, $user->two_factor_code));
            return redirect('/twoFactor');
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
        return redirect()->route('login.show');
    }

    public function attemptLogin($credentials)
    {
        return Auth::attempt($credentials);
    }

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