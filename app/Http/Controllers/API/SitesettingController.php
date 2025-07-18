<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page)
    {
        $sitesettings = SiteSetting::where('page', $page)->get();
        return response()->json($sitesettings, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'favicon' => 'nullable|string|max:255', // ideally URL or path string
            'nav_icon' => 'nullable|string|max:255',
            'nav_title' => 'required|string|max:255',
            'footer_icon' => 'nullable|string|max:255',
            'footer_title' => 'required|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'page' => 'nullable|string|max:255',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        SiteSetting::create($validated);

        return response()->json(['message' => 'SiteSetting link created successfully.'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sitesetting = SiteSetting::findOrFail($id);

        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'favicon' => 'nullable|string|max:255',
            'nav_icon' => 'nullable|string|max:255',
            'nav_title' => 'required|string|max:255',
            'footer_icon' => 'nullable|string|max:255',
            'footer_title' => 'required|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'page' => 'nullable|string|max:255',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        $sitesetting->update($validated);

        return response()->json(['message' => 'SiteSetting link updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sitesetting = SiteSetting::findOrFail($id);
        $sitesetting->delete();

        return response()->json(['message' => 'SiteSetting link deleted successfully.'], 200);
    }
}
