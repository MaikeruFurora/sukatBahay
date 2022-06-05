<?php

namespace App\Http\Controllers;

use App\Models\ReviseYear;
use App\Models\Rule;
use App\Models\Section;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function search(Request $request){
         return response()->json(Rule::searchdata($request->q));
    }

    public function ruleSection(Rule $rule,Section $section){
        $year = ReviseYear::all();
        $unique = array();
        // return $this->collectYears($section->contents);
        return view('users/rule-section',[
                'unique'=>$this->collectYears($section->contents),
        ],
            compact('rule','section','year'));
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

}
