<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        $userCount = User::where("user_type","no")->where("email_verified",1)->count();
        $userNotVerified = User::where("user_type","no")->where("email_verified",0)->count();
        $ruleCount = Rule::count();

        // return User::select(DB::raw("MONTH(created_at) month"),DB::raw("COUNT(created_at) as total"))->where("user_type","no")->groupBy("month")->get();

        return view('administrator/dashboard/dashboard',[
            'userCount' => $userCount ?? 0,
            'userNotVerified' => $userNotVerified ?? 0,
            'ruleCount' => $ruleCount ?? 0,
        ]);

    }

    /**
     * 
     * USERS FUNCTION
     * 
     */

    public function users(){
        
        return view('administrator/user/user');

    }

    
    
    public function userList(Request $request){

            $columns = array( 

                0 =>'fullname',

                1 =>'email',

                2 =>'created_at',

            );
            
            $totalData = User::where('user_type','no')->count();
    
            $totalFiltered = $totalData; 
    
            $limit = $request->input('length');

            $start = $request->input('start');

            $order = $columns[$request->input('order.0.column')];

            $dir = $request->input('order.0.dir');

    
            if(empty($request->input('search.value'))){          
            $posts = User::where('user_type','no')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->get();
            } else {
            $search = $request->input('search.value'); 
    
            $posts =  User::where('user_type','no')
                            ->orWhere('fullname', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->get();
    
            $totalFiltered =User::where('user_type','no')
                                ->orWhere('fullname', 'LIKE',"%{$search}%")
                                ->orWhere('email', 'LIKE',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->latest()
                                ->count();
            }
    
            $data = array();

            if(!empty($posts)) {

                foreach ($posts as $post) {
    
                $nestedData['fullname'] = $post->fullname;

                $nestedData['email'] = $post->email;

                $nestedData['created_at'] = $post->created_at;
                // $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                // $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                                        // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
                $data[] = $nestedData;
    
                }
            }
    
            $json_data = array(

                "draw"            => intval($request->input('draw')), 

                "recordsTotal"    => intval($totalData),  

                "recordsFiltered" => intval($totalFiltered), 

                "data"            => $data   
                
                );
    
            echo json_encode($json_data); 
    }

    /**
     * 
     * Admins
     * 
     */

     public function account(){
         return view('administrator/account/account');
     }


}
