<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * List all content or filter by component/page.
     */
    public function index(Request $request)
    {
        $component = $request->query('component'); // ?component=services
        $status = $request->query('status'); // ?status=active

        $query = Content::query();

        if ($component) {
            $query->where('component', $component);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $contents = $query->get();

        return response()->json([
            'success' => true,
            'data' => $contents,
        ], 200);
    }

    /**
     * Store new content.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'headings' => 'required|string|max:255',
            'sub_headings' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|string', // image URL/path
            'video' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'component' => 'required|in:' . implode(',', array_keys(Content::COMPONENTS)),
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'Guest';

        $content = Content::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Content created successfully.',
            'data' => $content,
        ], 201);
    }

    /**
     * Show specific content by ID.
     */
    public function show(string $id)
    {
        $content = Content::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $content,
        ], 200);
    }

    /**
     * Update existing content.
     */
    public function update(Request $request, string $id)
    {
        $content = Content::findOrFail($id);

        $validated = $request->validate([
            'headings' => 'sometimes|required|string|max:255',
            'sub_headings' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'status' => 'sometimes|required|in:active,inactive',
            'component' => 'sometimes|required|in:' . implode(',', array_keys(Content::COMPONENTS)),
        ]);

        $validated['updated_by'] = Auth::user()->name ?? $content->updated_by;

        $content->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Content updated successfully.',
            'data' => $content,
        ], 200);
    }

    /**
     * Delete content.
     */
    public function destroy(string $id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return response()->json([
            'success' => true,
            'message' => 'Content deleted successfully.',
        ], 200);
    }
}
