<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class FrontController extends Controller
{
        public function industry(){
            $industries = Industry::all();
            return view('admin.industry.index', compact('industries'));
          
        }
        public function industryAdd(){
            if(request()->isMethod('post')){
                $industryData = new Industry();
                $industryData->icon = request('icon');
                $industryData->title = request('title');
                $industryData->description = request('description');
                $industryData->services = json_encode(request('services', []));
                $industryData->save();
            }
            
            return view('admin.industry.add');
        }

}
