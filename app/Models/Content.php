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
}
