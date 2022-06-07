<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ReviseYear;
use App\Models\Rule;
use App\Models\Section;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class SearchController extends Controller
{
    
    public function autoSuggest(Request $request){

         return response()->json(Content::searchdata($request->q));

    }

    public function sectionContent(Section $section,$keyword=null){
     
        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $keyword);

        $replace_string = '<span style="background:gray;color:white">'.$condition.'</span>';

        return view('users/section-content',[

                'unique'=>$this->collectYears($section->contents),

                'rule'=>Rule::find($section->rule_id),

                'section'=>$section,

                'year'=>ReviseYear::all(),

                'condition'=>$condition,

                'replace_string'=>$replace_string,

            ]);

    }

    public function collectYears($value){

        $collection = collect('No Revision');

        $flag=true;

            foreach ($value as $item) {

                if (!empty($item->reviseYear->year)) {

                    $collection->push($item->reviseYear->year);

                    $flag=false;

                }

            }


            if($flag){

                return $collection->unique()->values()->all();

            }else{

                 $collection->shift();

                 return $collection->unique()->all();

            }
    }

    public function searchForce(Request $request){
        
          $result = Content::with(['section:id,rule_id,section_title,slug','section.rule:id,title,slug','reviseYear:id,year'])

        ->select('content_text','id','revise_year_id','section_id')

        ->where("content_text",'like','%'.$request->search.'%')

        ->paginate(7);


        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->search);

        $replace_string = '<span style="background:gray;color:white">'.$condition.'</span>';

        return view('users.search-force',compact('result','condition','replace_string'));

    }


    public function ruleContent(Rule $rule,Section $section,$keyword=null){

        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $keyword);
        return view('users.rule-content',[

            'rule' =>$rule,

            'section' =>$section,

            'keyword' =>$keyword,

            'condition' => $condition,

            'replace_string' => '<span style="background:gray;color:white">'.$condition.'</span>',

            'unique'=>$this->collectYears($section->contents),

        ]);

    }

}
