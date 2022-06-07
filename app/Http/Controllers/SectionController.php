<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index($rule_id){

        $ruleData = Rule::find($rule_id);

       return view('administrator.rule_section.section',compact('ruleData'));

    }

    public function sectionStore(){

        return Section::store();

    }

    public function sectionEdit(Section $section){

        return response()->json($section);

    }

    public function sectionList(Request $request,$id){
        $columns = array( 

            0 =>'section_no', 

            1 =>'section_title',
            
            2 =>'updated_at',

            3 =>'id',
        );
        
        $totalData = Section::select('sections.id','sections.updated_at','section_no','section_title')->join('rules','sections.rule_id','rules.id')
                        ->where('rules.id',$id)
                        ->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        
        $start = $request->input('start');
        
        $order = $columns[$request->input('order.0.column')];
        
        $dir = $request->input('order.0.dir');
        

        if(empty($request->input('search.value')))
        {          
        $posts = Section::select('sections.id','sections.updated_at','sections.created_at','section_no','section_title')->join('rules','sections.rule_id','rules.id')
                        ->where('rules.id',$id)
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->latest()
                        ->get();
        }else {

        $search = $request->input('search.value'); 

        $posts =  Section::select('sections.id','sections.updated_at','sections.created_at','section_no','section_title')->join('rules','sections.rule_id','rules.id')
                        ->where('rules.id',$id)
                        ->orWhere('section_no', 'LIKE',"%{$search}%")
                        ->orWhere('section_title', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->latest()
                        ->get();

        $totalFiltered =Section::select('sections.id','sections.updated_at','sections.created_at','section_no','section_title')->join('rules','sections.rule_id','rules.id')
                        ->where('rules.id',$id)
                        ->orWhere('section_no', 'LIKE',"%{$search}%")
                            ->orWhere('section_title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->latest()
                            ->count();
        }

        $data = array();

        if(!empty($posts)) {

            foreach ($posts as $post) {

                $nestedData['section_no'] = $post->section_no;

                $nestedData['section_title'] = $post->section_title;

                $nestedData['updated_at'] = $post->updated_at->format('F j,Y');

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
