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

    /**
     * Parse signature base64, render Dynamic PDF Contract with variables,
     * and save to database.
     */
    public function signContract(Request $request, $id)
    {
        $request->validate([
            'signature' => 'required|string', // Base64 image
        ]);

        $investorId = $request->user()->id;

        $investment = Investment::where('id', $id)
            ->where('user_id', $investorId)
            ->with(['project', 'user'])
            ->firstOrFail();

        if ($investment->contract_pdf_path) {
            return response()->json(['message' => 'Contract already signed.'], 400);
        }

        $signature = $request->input('signature');

        $data = [
            'DATE' => now()->format('Y-m-d'),
            'COMPANY_NAME' => 'iFuture Hub',
            'FOUNDER_NAME' => 'Emad Ghafari',
            'INVESTOR_NAME' => $investment->user->name,
            'INVESTOR_ID' => $investment->user->id,
            'PROJECT_NAME' => $investment->project->title,
            'PROJECT_DESCRIPTION' => $investment->project->description ?? 'Innovative Digital Platform',
            'INVESTMENT_AMOUNT' => $investment->amount,
            'CURRENCY' => 'USD',
            'SHARES_PERCENTAGE' => $investment->shares,
            'LOCK_PERIOD' => '12 months',
            'DIGITAL_SIGNATURE' => $signature,
        ];

        // Ensure UTF-8 config is solid for Arabic text in DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.investment', $data);

        $filename = 'contracts/contract_' . $investment->id . '_' . time() . '.pdf';
        \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $pdf->output());

        $investment->digital_signature = $signature;
        $investment->contract_pdf_path = '/storage/' . $filename;
        $investment->signed_at = now();
        $investment->save();

        return response()->json([
            'success' => true,
            'contract_url' => '/storage/' . $filename
        ]);
    }
}
