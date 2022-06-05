<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function rule(){
        return $this->belongsTo(Rule::class);
    }

    public function scopeStore($query){
        return $query->updateorcreate(['id'=>request('id')],[
            'rule_id'=>request('rule_id'),
            'answers'=>request('answers'),
            'question'=>request('question'),
        ]);
    }

    protected $casts=[
        'answers'=>'array'
    ];
}
