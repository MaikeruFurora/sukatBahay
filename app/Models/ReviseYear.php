<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviseYear extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function scopeStore($query){
        return $query->updateorcreate(['id'=>request('id')],[
            'year'=>request('year')
        ]);
    }
}
