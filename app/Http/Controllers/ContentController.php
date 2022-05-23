<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Rule;
use App\Models\Section;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Section $section){
       
        $data = $section->load('contents');
        $rule = Rule::find($section->rule_id);
        return view('administrator.section_content.content',compact('data','rule'));
    }

    public function contentStore(){
          Content::store();
        if (empty(request('id'))) {
            return redirect()->route('admin.content.create',request('section_id'))->with('msg','Content created successfully');
        } else {
            // return redirect()->route('admin.content.edit',$request->id)->with('msg','Content updated successfully');
            return redirect()->route('admin.content',request('section_id'));
            
        }
        

    }

    public function contentEdit(Content $content){
        // $rule = Rule::find($section->rule_id);
        return view('administrator.section_content.edit',compact('content'));
    }

    public function contentDelete($id){
         Content::find($id)->delete();
         return back();
    }

    public function contentCreate(Section $section){
        $data = $section->load('contents');
        $rule = Rule::find($section->rule_id);
        return view('administrator.section_content.create',compact('data','rule'));
    }
}
