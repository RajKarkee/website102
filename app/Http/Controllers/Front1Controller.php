<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\About;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class Front1Controller extends Controller
{
    public function industryPage(){
        $industryData=Industry::all();
        return view('industries',compact('industryData'));
    }




    public function aboutPage(){
        $aboutData=About::all();
        return view('about', compact('aboutData'));
       
    }
}
