<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        // parent::__construct;
    }

    public function login_post(Request $request){

        $request->validate([

            'email' => 'required',

            'password' => 'required',

        ]);

        

        if (Auth::guard('web')->attempt($request->except(['_token','_method']))) {
            

            $user = User::select('user_type',"email_verified")->whereId(Auth::user()->id)->first();
            
            if (!$user->email_verified) {

                Auth::guard('web')->logout();

                return redirect()->route('auth.login')->with(['msg'=>'You need to cofirm your account, We sent you an activation link, Please check your email','action'=>'danger']);
            
            }

            if ($user->user_type=='yes') {

                return redirect()->route('admin.dashboard');

            } else {

                return redirect()->route('welcome');

            }

        }else{

            return back()->with(['msg'=>'Login credentials are invalid','action'=>'warning']);

        }
    }

    public function regiter_post(Request $request){

        // DB::transaction(function() use($request){

            $request->validate([

                'email'=>'required|unique:users,email',
                'confirm_password'=>'required|same:password',
    
            ]);
    
            $token = hash("sha256",Str::random(120));
    
            $url   = route('auth.verified',['token'=>$token,'email'=>$request->email]);
    
             Mail::send('auth/email-verified',['action_link'=>$url],function($message) use ($request){
    
                $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'));
    
                $message->to($request->email,$request->fullname)
    
                        ->subject('Activate '.$request->fullname);
    
            });
    
             $user = User::create([
    
                'fullname'=>$request->fullname,
    
                'email'=>$request->email,
    
                'password'=>Hash::make($request->password),
    
            ]);
    
            VerifyUser::create([
                'user_id'=>$user->id,
                'token'=>$token
            ]);
            
            
        // });
        
        return back()->with([

            'msg'=>"We sent you an email verification to verify your account, Please check your email!",

            "action"=>"info"

        ]);

    }

    public function logout() {

        if (Auth::guard('web')->check()) {

            Auth::guard('web')->logout();

            return redirect()->route('welcome');

        }
        
    }

    public function forgot_post(Request $request){

        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([

            'email'=>$request->email,

            'token'=>$token,

            'created_at'=>Carbon::now()

        ]);

        $name = User::select('fullname')->where('email',$request->email)->first();

        $action_link = route('auth.reset',['token'=>$token,'email'=>$request->email]);

        Mail::send('auth/email-forgot',['action_link'=>$action_link],function($message) use ($request,$name){

            $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'));

            $message->to($request->email,$name->fullname)

                    ->subject('Reset Password');

        });

        return back()->with('msg',"Check your inbox for the next steps. If you don't receive an email, and it's not in your spam folder this could mean you signed up with a different address.");

    }


    public function reset_password(Request $request,$token=null){
        return view('auth.reset')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function reset_now(Request $request){

        $request->validate([

            'new_password'=>'required|min:6',

            'confirm_password'=>'required|same:new_password',

        ]);
        
        $exists = DB::table('password_resets')

        ->where('email',$request->email)

        ->where('token',$request->token)

        // ->latest()

        ->count();

        if ($exists>0) {
           
            DB::table('password_resets')

            ->where('email',$request->email)

            ->where('token',$request->token)

            ->delete();

                
            User::where('email',$request->email)->update([

                'password'=>bcrypt($request->new_password)

            ]);


         return redirect()->route('auth.login')->with('msg', 'Your Password has been changed! You can now Login with your new password');

        } else {
           
         return back()->with('msg', 'Sorry your token are Invalid, Please try again!');    

        }

    }

    public function verified(Request $request){

        if (!is_null($request->token)) {

            $userVerified = VerifyUser::where('token',$request->token)->first();

            if (!$userVerified->user->email_verified) {
                
                $userVerified->user->email_verified=true;

                $userVerified->user->save();

                return redirect()->route('auth.login')->with(['msg'=>"You are now verified user, Thank you!",

                            'action'=>"success"

                ]); 

            } else{

                return redirect()->route('auth.login')->with(['msg'=>"You are already verified user Thank you!",

                            'action'=>"info"

                ]); 
            }
        
        } else {

            return redirect()->route('auth.login')->with(['msg'=>"You are not verified, We sent you an email please check your email for verification, Thank you",]); 

        }
        


    }

}
