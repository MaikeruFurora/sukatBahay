<?php

namespace App\Http\Controllers;

use App\Models\Rule;
// use App\Helpers\ConvertRN;
use Illuminate\Http\Request;

class RuleController extends Controller
{

    public function rules(){
        return view('administrator/rule/rule');
    }

    public function ruleStore(){
       return Rule::store();
    }

    public function ruleEdit(Rule $rule){
        return response()->json($rule);
    }
    
    public function ruleList(Request $request){
            $columns = array( 
                0 =>'rule_no', 
                1 =>'title',
                2 =>'updated_at',
                3 =>'id',
            );
            
            $totalData = Rule::count();
    
            $totalFiltered = $totalData; 
    
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            if(empty($request->input('search.value')))
            {          
            $posts = Rule::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->get();
            }
            else {
            $search = $request->input('search.value'); 
    
            $posts =  Rule::orWhere('rule_no', 'LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->get();
    
            $totalFiltered =Rule::orWhere('rule_no', 'LIKE',"%{$search}%")
                                ->orWhere('title', 'LIKE',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->latest()
                                ->count();
            }
    
            $data = array();
            if(!empty($posts)) {
                foreach ($posts as $post) {
                    $nestedData['rule_no'] = $post->rule_no;
                    $nestedData['title'] = $post->title;
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
    