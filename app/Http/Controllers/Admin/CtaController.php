<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Cta;

class CtaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctas = Cta::all();
        return view('admin.cta.index', compact('ctas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allPages = [
            'home' => 'Home',
            'about' => 'About',
            'industries' => 'Industries',
            'services' => 'Services',
            'other' => 'Other',
        ];
        $usedPages = Cta::pluck('page')->toArray();
        $availablePages = array_diff_key($allPages, array_flip($usedPages));
        return view('admin.cta.create', compact('availablePages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button1_text' => 'required|string|max:255',
            'button2_text' => 'required|string|max:255',
        ]);
        $validated['icon'] = $request->input('icon', 'target');
        $validated['button1_url'] = route('contact');
        $validated['button2_url'] = route('services.index');
        Cta::create($validated);
        return redirect()->route('admin.cta.index')->with('success', 'CTA created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cta = Cta::findOrFail($id);
        return view('admin.cta.edit', compact('cta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button1_text' => 'required|string|max:255',
            'button1_url' => 'required|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_url' => 'nullable|string|max:255',
        ]);
        $cta = Cta::findOrFail($id);
        $cta->update($validated);
        return redirect()->route('admin.cta.index')->with('success', 'CTA updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cta = Cta::findOrFail($id);
        $cta->delete();
        return redirect()->route('admin.cta.index')->with('success', 'CTA deleted successfully.');
    }
}
