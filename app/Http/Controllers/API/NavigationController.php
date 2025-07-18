<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page)
    {
        $navigations = Navigation::where('page', $page)->get();
        return response()->json($navigations, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string',
            'type' => 'required|in:navbar,footer,both',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'page' => 'nullable|string|max:255',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        Navigation::create($validated);

        return response()->json(['message' => 'Navigation link created successfully.'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $navigation = Navigation::findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string',
            'type' => 'required|in:navbar,footer,both',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'page' => 'nullable|string|max:255',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        $navigation->update($validated);

        return response()->json(['message' => 'Navigation link updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $navigation = Navigation::findOrFail($id);
        $navigation->delete();

        return response()->json(['message' => 'Navigation link deleted successfully.'], 200);
    }
}
