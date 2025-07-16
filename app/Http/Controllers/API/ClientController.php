<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_logo' => 'nullable|string', // If you send a path or URL
            'type_of_client' => 'required|in:national,international',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'Guest'; // fallback if unauthenticated

        $client = Client::create($validated);

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'client_name' => 'sometimes|required|string|max:255',
            'client_logo' => 'nullable|string',
            'type_of_client' => 'sometimes|required|in:national,international',
        ]);

        $client = Client::findOrFail($id);
        $validated['updated_by'] = Auth::user()->name ?? $client->updated_by;

        $client->update($validated);

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Client deleted'], 200);
    }
}
