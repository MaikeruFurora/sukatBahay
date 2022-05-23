<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_post(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('web')->attempt($request->except(['_token','_method']))) {
            
            $userType = User::select('user_type')->whereId(Auth::user()->id)->first();
            
            if ($userType->user_type=='yes') {
                return redirect()->route('admin.dashboard');
            } else {
                // return redirect()->route('cover');
            }

        }else{
            return back()->with('msg', 'Login credentials are invalid');
        }
    }

    public function regiter_post(Request $request){
        $request->validate([
            'confirm_password'=>'same:password',
        ]);
         User::create([
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        if (Auth::guard('web')->attempt($request->only('email','password'))) {
            // return redirect()->route('cover');
        }
        return back();
    }

    public function logout() {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('welcome');
        }
    }
}
