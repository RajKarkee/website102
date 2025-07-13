<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        return view('industries');
    }
}
