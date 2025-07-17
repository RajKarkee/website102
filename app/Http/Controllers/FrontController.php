<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
        public function industry(){
            return view('admin.industry.index');
        }
}
