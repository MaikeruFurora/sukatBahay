<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index($rule_id){
        $ruleData=Rule::find($rule_id);
        return view('administrator.exercises.exercises',compact('ruleData'));
    }
}
