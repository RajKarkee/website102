<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('status', 1)->get();
        return view('testimonials', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function adminIndex()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'sub_description' => 'nullable|string',
            'others' => 'nullable|string',
        ]);

        $path = $request->file('image')?->store('testimonials', 'public');

        Testimonial::create([
            'image' => $path,
            'description' => $request->description,
            'sub_description' => $request->sub_description,
            'others' => $request->others,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'sub_description' => 'nullable|string',
            'others' => 'nullable|string',
            'status' => 'nullable|in:1',
        ]);

        $testimonial->description = $request->description;
        $testimonial->sub_description = $request->sub_description;
        $testimonial->others = $request->others;
        $testimonial->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function updateStatus(Testimonial $testimonial)
    {
        $testimonial->status = !$testimonial->status;
        $testimonial->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted.');
    }
}