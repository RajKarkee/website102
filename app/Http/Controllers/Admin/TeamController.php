<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Position;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = Team::with('position');
        // Filter by position
        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }
        // Sorting
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'position_asc':
                $query->join('positions', 'teams.position_id', '=', 'positions.id')
                    ->orderBy('positions.name', 'asc')
                    ->select('teams.*');
                break;
            case 'position_desc':
                $query->join('positions', 'teams.position_id', '=', 'positions.id')
                    ->orderBy('positions.name', 'desc')
                    ->select('teams.*');
                break;
        }
        $teams = $query->get();
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('admin.team.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'position_id' => 'required|exists:positions,id',
        ]);
        $data = $request->only('name', 'position_id');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }
        Team::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(Team $team)
    {
        $positions = Position::all();
        return view('admin.team.edit', compact('team', 'positions'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'position_id' => 'required|exists:positions,id',
        ]);
        $data = $request->only('name', 'position_id');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
