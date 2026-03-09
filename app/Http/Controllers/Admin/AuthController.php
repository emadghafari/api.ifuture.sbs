<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|string|in:admin,investor',
        ]);

        $verification_code = rand(10000, 99999);
        $expires_at = Carbon::now()->addMinutes(15);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'investor', // default to investor
            'verification_code' => $verification_code,
            'verification_code_expires_at' => $expires_at,
        ]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verification_code));
        }
        catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Registration successful. A verification code has been sent to your email.',
            'requires_verification' => true
        ], 201);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|min:5|max:5',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email is already verified.'], 400);
        }

        if ($user->verification_code !== $request->code) {
            return response()->json(['message' => 'Invalid verification code.'], 400);
        }

        if (Carbon::now()->isAfter($user->verification_code_expires_at)) {
            return response()->json(['message' => 'Verification code has expired. Please request a new one.'], 400);
        }

        $user->email_verified_at = Carbon::now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Email verified successfully.']);
    }

    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email is already verified.'], 400);
        }

        $verification_code = rand(10000, 99999);
        $expires_at = Carbon::now()->addMinutes(15);

        $user->verification_code = $verification_code;
        $user->verification_code_expires_at = $expires_at;
        $user->save();

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verification_code));
        }
        catch (\Exception $e) {
            \Log::error('Failed to resent verification email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send email. Please try again later.'], 500);
        }

        return response()->json(['message' => 'Verification code sent successfully.']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && !$user->email_verified_at) {
            return response()->json([
                'message' => 'Please verify your email address before logging in.',
                'requires_verification' => true
            ], 403);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Logged in successfully.', 'user' => Auth::user()]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out successfully.']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
