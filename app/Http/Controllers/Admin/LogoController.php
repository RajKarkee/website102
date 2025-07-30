<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Helpers\LogoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $logos = Logo::latest()->get();
        return view('admin.logo.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.logo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tagline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $logoData = $request->except(['logo_image']);

        if ($request->hasFile('logo_image')) {
            $logoData['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        $logo = Logo::create($logoData);

        // If this is the first logo or is_active is checked, make it active
        if (Logo::count() === 1 || $request->has('is_active')) {
            $logo->setAsActive();
        }

        // Clear cache
        LogoHelper::clearCache();

        return redirect()->route('admin.logo.index')->with('success', 'Logo created successfully!');
    }

    public function show(Logo $logo)
    {
        return view('admin.logo.show', compact('logo'));
    }

    public function edit(Logo $logo)
    {
        return view('admin.logo.edit', compact('logo'));
    }

    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tagline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $logoData = $request->except(['logo_image']);

        if ($request->hasFile('logo_image')) {
            // Delete old image
            if ($logo->logo_image) {
                Storage::disk('public')->delete($logo->logo_image);
            }
            $logoData['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        $logo->update($logoData);

        // If is_active is checked, make it active
        if ($request->has('is_active')) {
            $logo->setAsActive();
        }

        // Clear cache
        LogoHelper::clearCache();

        return redirect()->route('admin.logo.index')->with('success', 'Logo updated successfully!');
    }

    public function destroy(Logo $logo)
    {
        // Don't allow deletion of active logo if it's the only one
        if ($logo->is_active && Logo::count() === 1) {
            return redirect()->back()->with('error', 'Cannot delete the only active logo!');
        }

        // Delete image
        if ($logo->logo_image) {
            Storage::disk('public')->delete($logo->logo_image);
        }

        $logo->delete();

        // Clear cache
        LogoHelper::clearCache();

        return redirect()->route('admin.logo.index')->with('success', 'Logo deleted successfully!');
    }

    public function setActive(Logo $logo)
    {
        $logo->setAsActive();
        
        // Clear cache
        LogoHelper::clearCache();

        return redirect()->back()->with('success', 'Logo set as active successfully!');
    }
}
