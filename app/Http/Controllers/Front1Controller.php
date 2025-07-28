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
        $about=About::first(); // Assuming you want the first record for the about page
      function safe_decode($json) {
        $decoded = json_decode($json, true);
        return is_array($decoded) ? $decoded : ['title' => '', 'description' => '', 'icon' => ''];
    }

    $points = [
        1 => safe_decode(old('point_1', $about->point_1 ?? '')),
        2 => safe_decode(old('point_2', $about->point_2 ?? '')),
        3 => safe_decode(old('point_3', $about->point_3 ?? '')),
        4 => safe_decode(old('point_4', $about->point_4 ?? '')),
    ];
      
    
        return view('about', compact('aboutData', 'points','about'));
       
    }
    public function
}
