<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Middle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MiddleController extends Controller
{
    public function index()
    {
        $middles = Middle::all(); // Fetch all middle records
        // This method can be used to display a list of items or perform other actions
        return view('admin.middle.index', compact('middles'));
    }
    public function create(Request $request)
    {
        $middles = Middle::all(); // Fetch all middle records
        // This method can be used to handle the creation of a new item
        if ($request->isMethod('post')) {
            $data= new Middle();
            $data->title = $request->input('title');
            $data->short_description = $request->input('short_description');
            $data->page = $request->input('page'); // Assuming 'page' is    a field in the form
            $data->save(); 
            return redirect()->route('admin.middle.index')->with('success', 'Middle created successfully.');
        }

        // If the request is GET, show the form
        return view('admin.middle.create', compact('middles'));
    }   
    public function addPoint(Request $request, $id)
    {   
        // Get middle section with its points using query builder
        $middle = Middle::select('middles.*')
            ->leftJoin('middle_points', 'middles.id', '=', 'middle_points.middle_id')
            ->where('middles.id', $id)
            ->first();

        if (!$middle) {
            return redirect()->route('admin.middle.index')->with('error', 'Middle section not found.');
        }

        // Get all points for this middle section
        $points = DB::table('middle_points')
            ->where('middle_id', $id)
            ->get();

        if ($request->isMethod('post')) {
            // Validate the request
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Handle file upload
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('middle_points', 'public');
            }

            // Create new point using query builder
            DB::table('middle_points')->insert([
                'middle_id' => $id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'icon' => $iconPath ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.middle.index')
                ->with('success', 'Point added successfully.');
        }

        // If the request is GET, show the form for adding points
        return view('admin.middle.addPoint', compact('middle', 'points'));
    }
}
