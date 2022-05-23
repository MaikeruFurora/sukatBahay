<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function rules(){
        return $this->belongsTo(Rule::class);
    }

    public function scopeStore($query){
        return $query->updateorcreate(['id'=>request('id')],[
            'section_no'=>request('section_no'),
            'section_title'=>request('section_title'),
            'rule_id'=>request('rule_id'),
        ]);
    }

    public function contents(){
        return $this->hasMany(Content::class);
    }
}
