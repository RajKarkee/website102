<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Service;
use App\Models\Jumbotron;
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
        return redirect()->route('admin.service.index')
            ->with('success', 'Service created successfully.');
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
        return redirect()->route('admin.service.index')
            ->with('success', 'Service updated successfully.');
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
public function jumbotronIndex(){
    $jumbotrons = Jumbotron::all();
    return view('admin.jumbotron.index', compact('jumbotrons'));

}
public function jumbotronAdd(Request $request)
{
    if($request->isMethod('post')){
        // $validated =$request->validate([
        //     'page' => 'required|string|unique|jumbotrons,page',
        //     'title'=> 'required|string|max:255',
        //     'subtitle' => 'nullable|string|max:255',
        //     'description' => 'nullable|string',
        //     'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'icon' => 'nullable|string|max:255',
        //     'badge' => 'nullable|string|max:255',   
        // ]);
        if($request->hasFile('background_image')){
            $path = $request->file('background_image')->store('jumbotrons', 'public');
            // $validated['background_image'] = $path;

        }
        if($request->hasFile('icon')){
            $iconPath = $request->file('icon')->store('jumbotron_icons', 'public');
            // $validated['icon'] = $iconPath;
        }

        $jumbotron = new Jumbotron();
        $jumbotron->page = $request->input('page');
        $jumbotron->title = $request->input('title');
        $jumbotron->subtitle = $request->input('subtitle');
        $jumbotron->description = $request->input('description');
        $jumbotron->background_image = $path ?? null;
        $jumbotron->icon = $iconPath ?? null;
        $jumbotron->badge = $request->input('badge');
        $jumbotron->is_active = true; // Default to active
        $jumbotron->save();
        return redirect()->route('admin.jumbotron.index')
            ->with('success', 'Jumbotron created successfully.');
    }
    return view('admin.jumbotron.add');
}
public function jumbotronEdit($id, Request $request)
{
    $jumbotron = Jumbotron::findOrFail($id);
    if ($request->isMethod('post')) {
        if ($request->hasFile('background_image')) {
            if ($jumbotron->background_image) {
                Storage::disk('public')->delete($jumbotron->background_image);
            }
            $path = $request->file('background_image')->store('jumbotrons', 'public');
            $jumbotron->background_image = $path;
        }
        if ($request->hasFile('icon')) {
            if ($jumbotron->icon) {
                Storage::disk('public')->delete($jumbotron->icon);
            }
            $iconPath = $request->file('icon')->store('jumbotron_icons', 'public');
            $jumbotron->icon = $iconPath;
        }

        $jumbotron->page = $request->input('page');
        $jumbotron->title = $request->input('title');
        $jumbotron->subtitle = $request->input('subtitle');
        $jumbotron->description = $request->input('description');
        $jumbotron->badge = $request->input('badge');
        $jumbotron->is_active = true; // Default to active
        $jumbotron->save();
        
        return redirect()->route('admin.jumbotron.index')
            ->with('success', 'Jumbotron updated successfully.');
    }

    return view('admin.jumbotron.edit', compact('jumbotron'));
}
public function jumbotronDelete($id)
{
    $jumbotron = Jumbotron::findOrFail($id);
    if ($jumbotron->background_image) {
        Storage::disk('public')->delete($jumbotron->background_image);
    }
    if ($jumbotron->icon) {
        Storage::disk('public')->delete($jumbotron->icon);
    }
    $jumbotron->delete();
    
    return redirect()->route('admin.jumbotron.index')
        ->with('success', 'Jumbotron deleted successfully.');

}
public function statusChange($id, Request $request)
{
    $jumbotron = Jumbotron::findOrFail($id);
    $jumbotron->is_active = !$jumbotron->is_active; // Toggle the status
    $jumbotron->save();

    return redirect()->route('admin.jumbotron.index')
        ->with('success', 'Jumbotron status updated successfully.');
}
}
