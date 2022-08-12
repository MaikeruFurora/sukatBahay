<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function rule(){
        return $this->belongsTo(Rule::class);
    }

    public function scopeStore($query){
        
        return $query->updateorcreate(['id'=>request('id')],[
            'section_no'=>request('section_no'),
            'slug'=>$this->makeSlug(request('section_title')),
            'section_title'=>request('section_title'),
            'rule_id'=>request('rule_id'),
        ]);
    }

    public function contents(){
        return $this->hasMany(Content::class)->whereNull('sub_content_id');
    }

    private function makeSlug($value){
        $exist = static::where('slug',$value)->count();
        if ($exist>0) {
             return Str::slug($value." ".rand(10,200));
        } else {
            return Str::slug($value);   
        }
    }

    protected $casts = [
        
        'section_no'=>'integer',
        
    ];

}
