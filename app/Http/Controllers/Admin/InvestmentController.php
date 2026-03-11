<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Investment::with(['user', 'project'])->latest()->get();
    }

    public function show(string $id)
    {
        $investment = Investment::with(['user', 'project'])->findOrFail($id);
        return response()->json($investment);
    }
}
