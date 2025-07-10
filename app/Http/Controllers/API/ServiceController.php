<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // You can expand this as needed
        $validated = $request->validate([
            'description' => 'required|string',
            'description_for_list' => 'nullable|string',
            'list' => 'nullable|string',
            'image' => 'nullable|string',
            'component_title' => 'required|string',
            'service_icon' => 'nullable|string',
            'service_name' => 'nullable|string',
            'service_description' => 'nullable|string',
            'service_features' => 'nullable|string',
            'service_image' => 'nullable|string',
            'updated_by' => 'nullable|string',
        ]);

        $service = Service::create($validated);

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $service->update($request->all());

        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service deleted'], 200);
    }
}
