<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectRevenue;
use Illuminate\Http\Request;

class ProjectRevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ProjectRevenue::with('project')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
        ]);

        $revenue = ProjectRevenue::create($validated);
        return response()->json($revenue->load('project'), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $revenue = ProjectRevenue::findOrFail($id);
        $revenue->delete();
        return response()->json(null, 204);
    }
}
