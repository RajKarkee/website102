<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Service;
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
    $services = Service::all();
    return view('admin.services.index', compact('services'));
}

public function serviceAdd(Request $request)
{
    if (request()->isMethod('post')) {
        $serviceData = new Service();
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('service_icons', 'public');
            $serviceData->icon = $path;
        }
        $serviceData->title = request('title');
        $serviceData->description = request('description');
        $serviceData->long_description = request('long_description');
        $serviceData->points = json_encode(request('points', []));
        $serviceData->points_description = json_encode(request('points_description', []));
        $serviceData->point_icon = json_encode(request('point_icon', []));
        $serviceData->icon_title = json_encode(request('icon_title', []));
        $serviceData->icon_description = json_encode(request('icon_description', []));
        $serviceData->save();
    }

    return view('admin.services.add');
}

public function serviceEdit($id, Request $request)
{
    $serviceData = Service::findOrFail($id);
    if ($request->isMethod('post')) {
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('service_icons', 'public');
            $serviceData->icon = $path;
        }
        $serviceData->title = request('title');
        $serviceData->description = request('description');
        $serviceData->long_description = request('long_description');
        $serviceData->points = json_encode(request('points', []));
        $serviceData->points_description = json_encode(request('points_description', []));
        $serviceData->point_icon = json_encode(request('point_icon', []));
        $serviceData->icon_title = json_encode(request('icon_title', []));
        $serviceData->icon_description = json_encode(request('icon_description', []));
        $serviceData->save();
    }

    return view('admin.services.edit', compact('serviceData'));
}

public function serviceDelete($id)
{
    $serviceData = Service::findOrFail($id);
    $serviceData->delete();
    return redirect()->route('admin.service.index')->with('success', 'Service deleted successfully.');
}

public function serviceDetails($id)
{
    $service = Service::findOrFail($id);
    return response()->json([
        'id' => $service->id,
        'title' => $service->title,
        'description' => $service->description,
        'long_description' => $service->long_description,
        'points' => $service->points,
        'points_description' => $service->points_description,
        'icon_title' => $service->icon_title,
        'icon_description' => $service->icon_description
    ]);
}

}
