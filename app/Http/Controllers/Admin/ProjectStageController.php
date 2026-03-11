<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectStage;
use Illuminate\Http\Request;

class ProjectStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectStage::with('project')->orderBy('project_id')->orderBy('order_index')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'order_index' => 'integer'
        ]);

        $stage = ProjectStage::create($validated);
        return response()->json($stage, 201);
    }

    public function show(string $id)
    {
        $stage = ProjectStage::with('project')->findOrFail($id);
        return response()->json($stage);
    }

    public function update(Request $request, string $id)
    {
        $stage = ProjectStage::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
            'order_index' => 'integer'
        ]);

        $stage->update($validated);
        return response()->json($stage);
    }

    public function destroy(string $id)
    {
        $stage = ProjectStage::findOrFail($id);
        $stage->delete();
        return response()->json(null, 204);
    }
}
