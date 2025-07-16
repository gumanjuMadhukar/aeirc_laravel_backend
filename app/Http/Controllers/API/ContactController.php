<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'map_iframe' => 'nullable|string',

        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'Guest';

        $contact = Contact::create($validated);

        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'address' => 'sometimes|required|string|max:255',
            'mobile' => 'sometimes|required|string|max:255',
            'email' => 'nullable|string|max:255',
            'map_iframe' => 'nullable|string',

        ]);

        $contact = Contact::findOrFail($id);

        $validated['updated_by'] = Auth::user()->name ?? $contact->updated_by;

        $contact->update($validated);

        return response()->json($contact, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Contact deleted'], 200);
    }
}
