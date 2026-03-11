<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return TeamMember::with('translations')->orderBy('sort_order')->get();
    }

    public function store(Request $request)
    {
        // If translations is sent as a JSON string in FormData
        if (is_string($request->translations)) {
            $request->merge(['translations' => json_decode($request->translations, true)]);
        }

        $validated = $request->validate([
            'type' => 'required|string',
            'photo' => 'nullable|image|max:10240',
            'facebook_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|in:ar,he,en',
            'translations.*.name' => 'required|string',
            'translations.*.role' => 'required|string',
            'translations.*.bio' => 'nullable|string',
        ]);

        $data = $request->only(['type', 'facebook_url', 'twitter_url', 'linkedin_url', 'sort_order']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo_path'] = '/files/' . $path;
        }

        $member = TeamMember::create($data);

        foreach ($request->translations as $trans) {
            $member->translations()->create($trans);
        }

        return response()->json($member->load('translations'), 201);
    }
    public function show(TeamMember $team)
    {
        return $team->load('translations');
    }

    public function update(Request $request, TeamMember $team)
    {
        try {
            // Decode translations if sent as a JSON string from FormData
            $translations = $request->translations;
            if (is_string($translations)) {
                $decoded = json_decode($translations, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $request->merge(['translations' => $decoded]);
                }
                else {
                    return response()->json(['message' => 'Invalid JSON in translations array.'], 422);
                }
            }

            $validated = $request->validate([
                'type' => 'required|string',
                'photo' => 'nullable|image|max:10240',
                'facebook_url' => 'nullable|string',
                'twitter_url' => 'nullable|string',
                'linkedin_url' => 'nullable|string',
                'sort_order' => 'integer',
                'translations' => 'required|array',
                'translations.*.locale' => 'required|string|in:ar,he,en',
                'translations.*.name' => 'required|string',
                'translations.*.role' => 'required|string',
                'translations.*.bio' => 'nullable|string',
            ]);

            $data = $request->only(['type', 'facebook_url', 'twitter_url', 'linkedin_url', 'sort_order']);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
                $data['photo_path'] = '/files/' . $path;
            }

            $team->update($data);

            foreach ($request->translations as $trans) {
                $team->translations()->updateOrCreate(
                ['locale' => $trans['locale']],
                    $trans
                );
            }

            return response()->json($team->load('translations'));
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        }
        catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Team update error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'message' => 'Exception: ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function destroy(TeamMember $team)
    {
        $team->translations()->delete();
        $team->delete();
        return response()->json(null, 204);
    }
}
