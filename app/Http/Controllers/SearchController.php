<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
         return response()->json(Rule::searchdata($request->q));
    }
}
