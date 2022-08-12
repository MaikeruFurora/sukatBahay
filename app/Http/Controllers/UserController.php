<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Content;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bookmark(Content $content){

        if (auth()->guest()) {

           return redirect()->route('auth.login')->with('msg','You are not authorize');

        }

        if (!$content->bookmarkedBy()) {     
             $content->bookmarks()->create([
                'user_id'=>auth()->user()->id
            ]);

            return back()->with(['msg'=>'Successfully saved']);;

        }

        return back();
        
        
    }

    public function create(){

        $res =  User::store();

        if ($res) {
            return back()->with('msg','Successfully saved!');
        }else{
            return back()->with('msg','Failed!, Please try later');
        }

    }

    public function profile(){

        return view('users.user-profile');

    }

    public function bookmarkDestroy($id){

        Bookmark::where('content_id',$id)->where('user_id',auth()->user()->id)->delete();
        
        return back()->with(['msg'=>'Successfully removed']);

    }

    public function bookmarkList(){
        $myBookmarks = auth()->user()->load(['bookmarks']);
        return view('layout.userLayout.offcanvas',compact('myBookmarks'));
    }

}
