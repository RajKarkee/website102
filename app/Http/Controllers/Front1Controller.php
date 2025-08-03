<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\About;
use App\Models\Service;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Front1Controller extends Controller
{
    public function industryPage(){
        $industryData=Industry::all();
     
        // foreach ($industryData as $industry) {
        //     $industry->services = json_decode($industry->services, true);
        // }
          
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
    public function servicePage(){
        // $serviceData=Service::all();
        $serviceData = DB::table('services')
            ->join('colors', 'services.colors', '=', 'colors.id')
            ->select('services.*', 'colors.tailwind_class as color')
            ->get()
            ->map(function ($service) {
                $service = (array) $service;
                $service['points'] = json_decode($service['points'] ?? '[]', true);
                $service['points_description'] = json_decode($service['points_description'] ?? '[]', true);
                $service['point_icon'] = json_decode($service['point_icon'] ?? '[]', true);
                $service['icon_title'] = json_decode($service['icon_title'] ?? '[]', true);
                $service['icon_description'] = json_decode($service['icon_description'] ?? '[]', true);
                return $service;
            })
            ->toArray();  
        return view('services.index', compact('serviceData'));

}
}
