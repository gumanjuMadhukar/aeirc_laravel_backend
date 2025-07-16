<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleryList = Gallery::all();
        return response()->json($galleryList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // You can expand this as needed
        $validated = $request->validate([
            'gallery_img' => 'required|string',
            'img_name' => 'required|string',
            'updated_by' => 'nullable|string',
        ]);

        $gallery = Gallery::create($validated);

        return response()->json($gallery, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->update($request->all());

        return response()->json($gallery, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json(['message' => 'Gallery deleted'], 200);
    }
}
