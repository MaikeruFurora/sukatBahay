<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        return view('administrator/dashboard/dashboard');

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
