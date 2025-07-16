<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string', // URL or path to image
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'Guest';

        $team = Team::create($validated);

        return response()->json($team, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);
        return response()->json($team, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|string',
            'position' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $team = Team::findOrFail($id);

        $validated['updated_by'] = Auth::user()->name ?? $team->updated_by;

        $team->update($validated);

        return response()->json($team, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Team deleted'], 200);
    }
}
