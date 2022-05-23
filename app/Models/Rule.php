<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
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

       return Section::join('rules','sections.rule_id','rules.id')
       ->join('contents','sections.id','contents.section_id')
       ->where('rules.title','like',"%{$keyword}%")
       ->orwhere('sections.section_title','like',"%{$keyword}%")
       ->orwhere('contents.comparison_one','like',"%{$keyword}%")
       ->orwhere('contents.comparison_two','like',"%{$keyword}%")
       ->orwhere('contents.comparison_none','like',"%{$keyword}%")
       ->get();
    }


}
