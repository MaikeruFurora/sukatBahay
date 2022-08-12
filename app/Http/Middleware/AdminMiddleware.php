<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $userType = User::select('user_type')->whereId(Auth::user()->id)->first();

        if (auth()->user()) {
            if ($userType->user_type=='yes') {
                return $next($request);
            } else {
                return redirect()->route('welcome');
            }
        } else {
            if (Auth::guard('web')->check()) {
                Auth::guard('web')->logout();
            }
             return redirect()->route('auth.sign_in')->with('msg','You are not allowed to access this system');
    
        }
    }
}
