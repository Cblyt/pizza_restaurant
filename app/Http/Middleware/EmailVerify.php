<?php

namespace App\Http\Middleware;

use Closure;

class EmailVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if(auth()->check())
        {           
            if($user->active != 1) {
                auth()->logout();

                return redirect()->route('login')->withMessage('The email has not been verified yet.');
            }
        }

        return $next($request);
    }
}
