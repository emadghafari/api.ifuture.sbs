<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Mail\InvestmentConfirmedAdmin;
use App\Mail\InvestmentConfirmedInvestor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Carbon\Carbon;

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
            'passport_number' => 'nullable|string|max:100',
            'passport_expiry' => 'nullable|date|date_format:Y-m-d',
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

        if ($request->filled('passport_number')) {
            $user->passport_number = $request->input('passport_number');
        }

        if ($request->filled('passport_expiry')) {
            $expiryInput = $request->input('passport_expiry');
            try {
                $parsedDate = \Carbon\Carbon::parse($expiryInput);
                if ($parsedDate->year > 2100 || $parsedDate->year < 1900) {
                    return response()->json(['message' => 'Invalid passport expiry year provided.'], 400);
                }
                $user->passport_expiry = $parsedDate->format('Y-m-d');
            }
            catch (\Exception $e) {
                return response()->json(['message' => 'Invalid passport expiry date format.'], 400);
            }
        }

        $user->save();

        if (empty($user->phone) || empty($user->passport_path) || empty($user->passport_number) || empty($user->passport_expiry)) {
            return response()->json(['message' => 'Missing KYC requirements. Please provide your phone number, passport number, expiry date, and upload a copy of your passport.'], 400);
        }

        // Get the absolute path to the passport file for embedding in the PDF
        $passportImagePath = null;
        if ($user->passport_path && file_exists(storage_path('app/public/' . str_replace('/storage/', '', $user->passport_path)))) {
            $passportImagePath = storage_path('app/public/' . str_replace('/storage/', '', $user->passport_path));
        }

        $signature = $request->input('signature');

        $data = [
            'DATE' => now()->format('Y-m-d'),
            'COMPANY_NAME' => 'iFuture SBS',
            'FOUNDER_NAME' => 'Emad Ghafari',
            'INVESTOR_NAME' => $user->name,
            'INVESTOR_PHONE' => $user->phone,
            'INVESTOR_ID' => $user->passport_number ?? $user->id,
            'PASSPORT_EXPIRY' => $user->passport_expiry,
            'PROJECT_NAME' => $investment->project->title,
            'PROJECT_DESCRIPTION' => $investment->project->description ?? 'Innovative Digital Platform',
            'INVESTMENT_AMOUNT' => $investment->amount,
            'CURRENCY' => 'USD',
            'SHARES_PERCENTAGE' => $investment->shares,
            'LOCK_PERIOD' => '12 months',
            'DIGITAL_SIGNATURE' => $signature,
            'PASSPORT_IMAGE_PATH' => $passportImagePath,
            'PASSPORT_IS_PDF' => $passportImagePath ? (strtolower(pathinfo($passportImagePath, PATHINFO_EXTENSION)) === 'pdf') : false,
        ];

        // Ensure robust UTF-8 and Arabic shaping using mPDF
        try {
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

            // Generate Invoice PDF
            $invoiceData = [
                'DATE' => now()->format('Y-m-d'),
                'INVESTOR_NAME' => $user->name,
                'INVESTOR_ID' => $user->passport_number ?? $user->id,
                'INVESTOR_EMAIL' => $user->email,
                'INVOICE_NUMBER' => str_pad($investment->id, 5, '0', STR_PAD_LEFT) . strtoupper(substr(uniqid(), -4)),
                'GATEWAY' => $investment->gateway ?? 'stripe',
                'TRANSACTION_ID' => $investment->transaction_id ?? 'N/A',
                'PROJECT_NAME' => $investment->project->title,
                'SHARES' => $investment->shares,
                'AMOUNT' => $investment->amount,
            ];

            $invoicePdf = \Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('contracts.invoice', $invoiceData, [], [
                'format' => 'A4',
                'orientation' => 'P',
                'title' => 'Purchase Invoice',
                'author' => 'iFuture SBS',
                'autoArabic' => true,
                'autoLangToFont' => true,
                'autoScriptToLang' => true,
            ]);

            $invoiceFilename = 'invoice_' . $investment->id . '_' . time() . '.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put('invoices/' . $invoiceFilename, $invoicePdf->output());

        }
        catch (\Throwable $e) {
            // Catch any Fatal errors or exceptions (like memory limit or file permissions)
            return response()->json([
                'message' => 'PDF Generation Error: ' . $e->getMessage() . ' in ' . basename($e->getFile()) . ':' . $e->getLine()
            ], 500);
        }

        $investment->digital_signature = $signature;
        $investment->contract_pdf_path = '/api/public/contracts/' . $filename;
        $investment->invoice_pdf_path = '/api/public/invoices/' . $invoiceFilename;
        $investment->signed_at = now();
        $investment->save();

        // Dispatch Confirmation Emails
        try {
            $contractAbsPath = storage_path('app/public/contracts/' . $filename);
            $invoiceAbsPath = storage_path('app/public/invoices/' . $invoiceFilename);

            // Send Investor Email
            \Illuminate\Support\Facades\Mail::to($user->email)->send(
                new \App\Mail\InvestmentConfirmedInvestor($investment, $contractAbsPath, $invoiceAbsPath)
            );

            // Send Admin Email
            $adminEmails = \App\Models\User::where('role', 'admin')->pluck('email');
            if ($adminEmails->count() > 0) {
                \Illuminate\Support\Facades\Mail::to($adminEmails)->send(
                    new \App\Mail\InvestmentConfirmedAdmin($investment, $contractAbsPath, $invoiceAbsPath)
                );
            }
        }
        catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mailing Error: ' . $e->getMessage());
        // Do not block the user response if mailing fails.
        }

        return response()->json([
            'success' => true,
            'contract_url' => $investment->contract_pdf_path
        ]);
    }
}
