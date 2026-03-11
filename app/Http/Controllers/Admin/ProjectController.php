<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Project::with('stages', 'investments')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:projects,slug|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:0',
            'status' => 'required|in:draft,funding,in_progress,completed',
            'url' => 'nullable|string|max:255',
            'total_shares' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = '/files/' . $path;
        }

        $project = Project::create($validated);
        return response()->json($project->load('stages'), 201);
    }

    public function show(string $id)
    {
        $project = Project::with('stages', 'investments.user')->findOrFail($id);
        return response()->json($project);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:projects,slug,' . $project->id . '|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'sometimes|required|numeric|min:0',
            'current_amount' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:draft,funding,in_progress,completed',
            'url' => 'nullable|string|max:255',
            'total_shares' => 'sometimes|required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = '/files/' . $path;
        }

        $project->update($validated);
        return response()->json($project->load('stages'));
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
