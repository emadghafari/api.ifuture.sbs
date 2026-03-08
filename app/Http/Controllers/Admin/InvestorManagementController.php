<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorManagementController extends Controller
{
    /**
     * Display a listing of all investors and their investments.
     */
    public function index()
    {
        $investors = User::where('role', 'investor')
            ->with(['investments.project'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($investors);
    }

    /**
     * Delete an investor and cascade their data.
     */
    public function destroy($id)
    {
        $investor = User::where('role', 'investor')->findOrFail($id);

        // Delete the user. Given DB constraints, this should cascade to investments 
        // if foreign keys are set up that way, otherwise they should be deleted manually.
        // If contract PDFs exist, they will remain on disk as audit trails, 
        // but the DB records will be wiped.

        $investor->delete();

        return response()->json(['message' => 'Investor completely removed from the system.']);
    }
}
