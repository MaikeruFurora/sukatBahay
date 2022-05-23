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
            'comparison'=>request('comparison'),
            'year'=>request('year'),
            'content'=>request('content')==="<p><br></p>"?null:request('content'),
        ]);
    }
}
