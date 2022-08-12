<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    public function scopeStore($query){
        return $query->updateorcreate(['id'=>request('id')],[
            'section_id'=>request('section_id'),
            'sub_content_id'=>request('sub_content_id'),
            'compare_id'=>request('compare_id'),
            'revise_year_id'=>request('revise_year_id'),
            'content'=>request('content')==="<p><br></p>"?null:request('content'),
            'content_text'=>request('content_text'),
        ]);
    }

    public function sub_content(){
        return $this->hasMany(Content::class,'sub_content_id');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function reviseYear(){
        return $this->belongsTo(ReviseYear::class);
    }

   


    public function scopeSearchdata($query,$keyword){
        
        // properties
        $data = array();
        
        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $keyword);

        $result = $query->with(['section:id,rule_id,section_title,slug','section.rule:id,title,slug'])

                        // ->whereHas('section',function($query) use($keyword){
                            
                        //     $query->where('section_title','like','%'.$keyword.'%');
                            
                        // })

                        ->when($keyword ?? false,function ($query,$keyword){

                             $query->where('content_text','like','%'.$keyword.'%');
                                            
                        })->limit(5)->get(); 

       $replace_string = '<b>'.$condition.'</b>';

        foreach($result as $key => $row){

            $start =  strrpos(strtolower($row->content_text),$keyword);

            $end   =  strlen($row->content_text);
            
            $data[] = array(

                'content'=>str_ireplace($condition, $replace_string, substr($row["content_text"],$start,$end)),

                'section'=>str_ireplace($condition, $replace_string, $row["section"]["section_title"]),

                'section_slug'=>str_ireplace($condition, $replace_string, $row["section"]["slug"]),

                'rule'=> $row["section"]["rule"]["title"],

                'rule_slug'=>str_ireplace($condition, $replace_string, $row["section"]["rule"]["slug"])

            );

        }
    
    return $data;
    
    }

    public function bookmarks(){

        return $this->hasMany(Bookmark::class);

    }

    public function bookmarkedBy(){

        return $this->bookmarks->contains("user_id",auth()->user()->id);

    }


}
