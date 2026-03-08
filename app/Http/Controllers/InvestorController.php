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
            'phone' => 'nullable|string|max:50',
            'passport_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $investorId = $request->user()->id;

        $investment = Investment::where('id', $id)
            ->where('user_id', $investorId)
            ->with(['project', 'user'])
            ->firstOrFail();

        if ($investment->contract_pdf_path) {
            return response()->json(['message' => 'Contract already signed.'], 400);
        }

        $user = $request->user();

        // Verify KYC Requirements
        // If user already has phone/passport from previous investments, we can allow missing from request.
        // But the user prompt says: "ان لم يرفع جواز السفر الخاص به و كتابة رقم هاتفه لا يمكنه اتمام الصفقة"
        // We will strictly check that the user ultimately has both before proceeding.
        if ($request->hasFile('passport_file')) {
            $path = $request->file('passport_file')->store('passports', 'public');
            $user->passport_path = '/storage/' . $path;
        }

        if ($request->filled('phone')) {
            $user->phone = $request->input('phone');
        }

        $user->save();

        if (empty($user->phone) || empty($user->passport_path)) {
            return response()->json(['message' => 'Missing KYC requirements. Please provide a phone number and upload your passport.'], 400);
        }

        $signature = $request->input('signature');

        $data = [
            'DATE' => now()->format('Y-m-d'),
            'COMPANY_NAME' => 'iFuture SBS',
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

        // Ensure robust UTF-8 and Arabic shaping using mPDF
        $pdf = \Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('contracts.investment', $data, [], [
            'format' => 'A4',
            'orientation' => 'P',
            'title' => 'Equity Investment Agreement',
            'author' => 'iFuture SBS',
            'autoArabic' => true,
            'autoLangToFont' => true,
            'autoScriptToLang' => true,
        ]);

        $filename = 'contract_' . $investment->id . '_' . time() . '.pdf';
        \Illuminate\Support\Facades\Storage::disk('public')->put('contracts/' . $filename, $pdf->output());

        $investment->digital_signature = $signature;
        $investment->contract_pdf_path = '/api/public/contracts/' . $filename;
        $investment->signed_at = now();
        $investment->save();

        return response()->json([
            'success' => true,
            'contract_url' => $investment->contract_pdf_path
        ]);
    }
}
