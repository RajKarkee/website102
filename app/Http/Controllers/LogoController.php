<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Helpers\LogoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = Logo::latest()->get();
        return view('admin.logo.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.logo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $logoData = $request->except(['logo_image', '_token']);
        $logoData['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('logo_image')) {
            $logoData['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        $logo = Logo::create($logoData);

        // If this logo is set as active, deactivate others and clear cache
        if ($logo->is_active) {
            $logo->setAsActive();
        }

        return redirect()->route('admin.logo.index')->with('success', 'Logo created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo)
    {
        return view('admin.logo.show', compact('logo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        return view('admin.logo.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $logoData = $request->except(['logo_image', '_token', '_method']);
        $logoData['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('logo_image')) {
            // Delete old file if exists
            if ($logo->logo_image && Storage::disk('public')->exists($logo->logo_image)) {
                Storage::disk('public')->delete($logo->logo_image);
            }
            $logoData['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        $logo->update($logoData);

        // If this logo is set as active, deactivate others and clear cache
        if ($logo->is_active) {
            $logo->setAsActive();
        } else {
            // Clear cache if logo was deactivated
            LogoHelper::clearCache();
        }

        return redirect()->route('admin.logo.index')->with('success', 'Logo updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logo $logo)
    {
        // Delete file if exists
        if ($logo->logo_image && Storage::disk('public')->exists($logo->logo_image)) {
            Storage::disk('public')->delete($logo->logo_image);
        }

        // Clear cache if this was the active logo
        if ($logo->is_active) {
            LogoHelper::clearCache();
        }

        $logo->delete();

        return redirect()->route('admin.logo.index')->with('success', 'Logo deleted successfully!');
    }

    /**
     * Activate a specific logo and deactivate others.
     */
    public function activate(Logo $logo)
    {
        $logo->setAsActive();
        
        return redirect()->route('admin.logo.index')->with('success', 'Logo activated successfully!');
    }
}
