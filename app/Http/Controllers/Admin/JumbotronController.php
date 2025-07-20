<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jumbotron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JumbotronController extends Controller
{
    public function index()
    {
        $jumbotrons = Jumbotron::all();
        return view('admin.jumbotron.index', compact('jumbotrons'));
    }

    public function create()
    {
        return view('admin.jumbotron.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|unique:jumbotrons,page',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('jumbotrons', 'public');
            $validated['background_image'] = $path;
        }

        Jumbotron::create($validated);

        return redirect()->route('admin.jumbotron.index')
            ->with('success', 'Jumbotron created successfully.');
    }

    public function edit(Jumbotron $jumbotron)
    {
        return view('admin.jumbotron.edit', compact('jumbotron'));
    }

    public function update(Request $request, Jumbotron $jumbotron)
    {
        $validated = $request->validate([
            'page' => 'required|string|unique:jumbotrons,page,' . $jumbotron->id,
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('background_image')) {
            // Delete old image
            if ($jumbotron->background_image) {
                Storage::disk('public')->delete($jumbotron->background_image);
            }
            
            $path = $request->file('background_image')->store('jumbotrons', 'public');
            $validated['background_image'] = $path;
        }

        $jumbotron->update($validated);

        return redirect()->route('admin.jumbotron.index')
            ->with('success', 'Jumbotron updated successfully.');
    }

    public function destroy(Jumbotron $jumbotron)
    {
        if ($jumbotron->background_image) {
            Storage::disk('public')->delete($jumbotron->background_image);
        }
        
        $jumbotron->delete();

        return redirect()->route('admin.jumbotron.index')
            ->with('success', 'Jumbotron deleted successfully.');
    }
}
