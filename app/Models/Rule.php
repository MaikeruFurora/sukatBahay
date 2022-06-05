<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Exercise;
use Illuminate\Support\Str;

class Rule extends Model
{
    use HasFactory;
    
    protected $guarded=[];

   /**
    * > The sections() function returns all the sections that belong to a particular course
    * 
    * @return A collection of Section objects
    */
    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function scopeStore($query){
        return $query->updateorcreate(['id' => request('id')],[
            'rule_no' => request('rule_no'),
            'slug' => $this->makeSlug(request('title')),
            'title' => ucwords(request('title')),
        ]);
    }

    /**
     * > The rulesContent function returns all the Content models that belong to the Section models
     * that belong to the current Rules model
     * 
     * @return A collection of Content objects
     */
    public function rulesContent(){
        return $this->hasManyThrough(Content::class,Section::class);
    }

    public function scopeSearchdata($query,$keyword){
        $data = array();
        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $keyword);
        $result = Section::join('rules','sections.rule_id','rules.id')
       ->join('contents','sections.id','contents.section_id')
    //    ->where('rules.title','like',"%{$condition}%")
    //    ->orwhere('sections.section_title','like',"%{$condition}%")
       ->orwhere('contents.content_text','like',"%{$condition}%")
       ->limit(5)
       ->get();

       $replace_string = '<b>'.$condition.'</b>';

	foreach($result as $row)
	{
		$data[] = array(
			'content'=>str_ireplace($condition, $replace_string, $row["content_text"]),
			'section'=>str_ireplace($condition, $replace_string, $row["section_title"])
		);
	}
    return $data;
    }

    public function exercises(){
        return $this->hasMany(Exercise::class);
    }

   private function makeSlug($value){
       $exist = static::where('slug',$value)->count();
       if ($exist>0) {
            return Str::slug($value." ".rand(10,200));
       } else {
           return Str::slug($value);   
       }
       
   }

}
