<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Whyus;
use Illuminate\Http\Request;

class WhyusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whyusList = Whyus::all();
        return response()->json($whyusList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'whyus_component_title' => 'required|string|max:255',
            // 'whyus_title' => 'required|string|max:255',
            // 'whyus_description' => 'required|string',
            'item_title' => 'required|string|max:255',
            'item_icon' => 'required|string|max:255',
            'item_description' => 'required|string',
            'updated_by' => 'nullable|string|max:255',
        ]);

        $whyus = Whyus::create($validated);

        return response()->json($whyus, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $whyus = Whyus::findOrFail($id);
        return response()->json($whyus, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $whyus = Whyus::findOrFail($id);

        $validated = $request->validate([
            // 'whyus_component_title' => 'required|string|max:255',
            // 'whyus_title' => 'required|string|max:255',
            // 'whyus_description' => 'required|string',
            'item_title' => 'required|string|max:255',
            'item_icon' => 'required|string|max:255',
            'item_description' => 'required|string',
            'updated_by' => 'nullable|string|max:255',
        ]);

        $whyus->update($validated);

        return response()->json($whyus, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $whyus = Whyus::findOrFail($id);
        $whyus->delete();

        return response()->json(['message' => 'Whyus entry deleted'], 200);
    }
}
