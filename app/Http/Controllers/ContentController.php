<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ReviseYear;
use App\Models\Rule;
use App\Models\Section;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Section $section){
     $data = $section->load('contents');
        $rule = Rule::find($section->rule_id);
        $year = ReviseYear::select('id','year')->orderBy('year','asc')->get();
        return view('administrator.section_content.content',compact('data','rule','year'));
    }

    public function contentStore(){
        Content::store();
    }

    public function contentList(Section $section,$year=null){
        return response()->json(
            $section->load(['contents.sub_content',
                           'contents.sub_content.sub_content',
                           'contents.reviseYear',
                           'contents'=>function($q) use($year){
                               if (empty($year)) {
                               $q->whereNull('revise_year_id');
                               }else{
                                   $q->where('revise_year_id',$year);
                               }
                           }])
                           
        );
    }

    public function contentEdit(Content $content){
    return response()->json(
        $content->load('reviseYear:year,id')
    );
    }

    public function contentDelete($id){
         return Content::find($id)->delete();
    }

    public function contentCreate(Section $section){
        $data = $section->load('contents');
        $rule = Rule::find($section->rule_id);
        return view('administrator.section_content.create',compact('data','rule'));
    }
}
