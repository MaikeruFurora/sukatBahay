<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->user()->email_verified) {
            Auth::guard('web')->logout();
            return redirect()->route('auth.login')->with([
                'msg'=>'You need to verified your account, we sent you an link to your email to verified your account',
                'action'=>'info'
            ]);
        }
        return $next($request);
    }
}
