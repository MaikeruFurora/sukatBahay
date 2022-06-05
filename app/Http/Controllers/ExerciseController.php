<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Rule;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Rule $rule){
        return view('administrator.exercises.exercises',compact('rule'));
    }

    public function create(){
       return  Exercise::store();
    }

    public function list(Rule $rule){
        return response()->json($rule->load('exercises'));
    }

    public function edit(Exercise $exercise){
        return response()->json($exercise);
    }

    public function destroy(Exercise $exercise){
        return $exercise->delete();
    }
}
