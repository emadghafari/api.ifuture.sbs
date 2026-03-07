<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class InvestorController extends Controller
{
    /**
     * Get all investments for the currently authenticated investor,
     * including the associated Project and its Stages.
     */
    public function getInvestments(Request $request)
    {
        $investorId = $request->user()->id;

        $investments = Investment::where('user_id', $investorId)
            ->with(['project.stages' => function ($query) {
            $query->orderBy('order_index', 'asc');
        }, 'project.revenues'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate earned dividends mathematically for each investment
        $investments->transform(function ($investment) {
            $totalRevenues = $investment->project->revenues->sum('amount');
            $totalShares = $investment->project->total_shares ?: 1; // Prevent division by zero
            $dividendPerShare = $totalRevenues / $totalShares;

            $investment->earned_dividend = $dividendPerShare * $investment->shares;
            return $investment;
        });

        return response()->json($investments);
    }
}
