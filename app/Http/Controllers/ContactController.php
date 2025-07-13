<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        // Handle form submission logic here
        // For now, just redirect back with success message
        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
