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
}
