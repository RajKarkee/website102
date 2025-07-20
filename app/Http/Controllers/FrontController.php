<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function industry()
    {
        $industries = Industry::all();
        return view('admin.industry.index', compact('industries'));
    }
    public function industryAdd(Request $request)
    {
        if (request()->isMethod('post')) {
            $industryData = new Industry();
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('industry_icons', 'public'); // saves in storage/app/public/industry_icons
                $industryData->icon = $path;
            }
            $industryData->title = request('title');
            $industryData->description = request('description');
            $industryData->services = json_encode(request('points', []));
            $industryData->save();
        }

        return view('admin.industry.add');
    }
    public function industryEdit($id, Request $request)
    {
        $industryData = Industry::findOrFail($id);
        if ($request->isMethod('post')) {
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('industry_icons', 'public'); // saves in storage/app/public/industry_icons
                $industryData->icon = $path;
            }
            $industryData->title = request('title');
            $industryData->description = request('description');
            $industryData->services = json_encode(request('points', []));
            $industryData->save();
        }

        return view('admin.industry.edit', compact('industryData'));
    }
    public function industryDelete($id)
    {
        $industryData = Industry::findOrFail($id);
        $industryData->delete();    
        return redirect()->route('admin.industry.index')->with('success', 'Industry deleted successfully.');
}
public function service(){
    return view('admin.services.index');
}
}
