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
         [$first,$second] = explode(' - ',request('title'));
        return $query->updateorcreate(['id' => request('id')],[
            'rule_no' => request('rule_no'),
            'slug' => $this->makeSlug(request('title')),
            'title' => strtoupper($first).' - '.$second,
        ]);
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

//    public function contents(){
//     return $this->hasManyThrough(Content::class,Section::class);
// }

}
