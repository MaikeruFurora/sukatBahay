<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bookmark(Content $content){

        if (auth()->guest()) {

           return redirect()->route('auth.login')->with('msg','You are not authorize');

        }

        // Bookmark::store();
        
        
    }
}
