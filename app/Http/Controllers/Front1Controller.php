<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class Front1Controller extends Controller
{
    public function industryPage(){
        $industryData=Industry::all();
        return view('industries',compact('industryData'));
    }
}
