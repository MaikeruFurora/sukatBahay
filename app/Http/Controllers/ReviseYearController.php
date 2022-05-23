<?php

namespace App\Http\Controllers;

use App\Models\ReviseYear;
use Illuminate\Http\Request;

class ReviseYearController extends Controller
{
    public function create(Request $request){
        return ReviseYear::store();
    }

    public function edit(ReviseYear $reviseYear){
        return response()->json($reviseYear);
    }

    public function list(Request $request){
        $columns = array( 
            0 =>'id', 
            1 =>'year',
            2 =>'created_at',
            2 =>'updated_at',
            3 =>'id',
        );
        
        $totalData = ReviseYear::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {          
        $posts = ReviseYear::offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->latest()
                        ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  ReviseYear::orWhere('year', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->latest()
                        ->get();

        $totalFiltered =ReviseYear::orWhere('year', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->count();
        }

        $data = array();
        if(!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['year'] = $post->year;
                $nestedData['created_at'] = $post->created_at->format('F j, Y');
                $nestedData['updated_at'] = $post->created_at->format('F j, Y');
                $nestedData['id'] = $post->id;
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
}
