<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('admin.position.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Position::create($request->only('name'));
        return redirect()->route('admin.position.index')->with('success', 'Position added successfully.');
    }

    public function edit(Position $position)
    {
        return view('admin.position.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $position->update($request->only('name'));
        return redirect()->route('admin.position.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.position.index')->with('success', 'Position deleted successfully.');
    }
}
