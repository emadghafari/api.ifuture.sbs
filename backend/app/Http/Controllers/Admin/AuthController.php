<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function sendRegistrationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $verification_code = rand(10000, 99999);

        // Store code in cache for 15 minutes keyed by email
        Cache::put('registration_code_' . $request->email, $verification_code, now()->addMinutes(15));

        try {
            Mail::to($request->email)->send(new VerificationCodeMail($verification_code));
        }
        catch (\Exception $e) {
            \Log::error('Failed to send registration code email: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'Failed to send verification code. ' . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }

        return response()->json(['message' => 'Verification code sent successfully.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|string|in:admin,investor',
            'verification_code' => 'required|string|size:5',
        ]);

        $cachedCode = Cache::get('registration_code_' . $request->email);

        if (!$cachedCode || $cachedCode != $request->verification_code) {
            return response()->json([
                'message' => 'Invalid or expired verification code.',
                'errors' => ['verification_code' => ['Invalid or expired verification code.']]
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'investor',
            'email_verified_at' => now(), // verified immediately
        ]);

        // clear cache
        Cache::forget('registration_code_' . $request->email);

        return response()->json([
            'message' => 'Registration successful.',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::validate($credentials)) {
            $user = User::where('email', $request->email)->first();

            // Bypass 2FA for admin users
            if ($user && $user->role === 'admin') {
                Auth::login($user);
                // Create a generic token just in case
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }

            $verification_code = rand(10000, 99999);

            // Store code in cache for 15 minutes keyed by email
            Cache::put('login_code_' . $request->email, $verification_code, now()->addMinutes(15));

            try {
                Mail::to($request->email)->send(new VerificationCodeMail($verification_code));
            }
            catch (\Exception $e) {
                \Log::error('Failed to send login code email: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
                return response()->json([
                    'message' => 'Failed to send verification code. ' . $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Verification code sent to email.',
                'requires_2fa' => true
            ]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'code' => 'required|string|size:5',
        ]);

        $cachedCode = Cache::get('login_code_' . $request->email);

        if (!$cachedCode || $cachedCode != $request->code) {
            return response()->json([
                'message' => 'Invalid or expired verification code.',
                'errors' => ['code' => ['Invalid or expired verification code.']]
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Auto-verify email if this is their first time logging in this way
            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }

            Cache::forget('login_code_' . $request->email);

            $request->session()->regenerate();
            return response()->json(['message' => 'Logged in successfully.', 'user' => $user]);
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

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If user exists but doesn't have a google_id, update them
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'email_verified_at' => $user->email_verified_at ?? now(),
                    ]);
                }
            }
            else {
                // Create new user if they don't exist
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => 'investor',
                    'email_verified_at' => now(), // Auto verify since Google verified it
                    'password' => null, // Optional password
                ]);
            }

            // Stateful login
            request()->session()->regenerate();
            Auth::login($user, true); // login and remember

            // Redirect back to Next.js dashboard
            $frontendUrl = env('FRONTEND_URL', 'https://ifuture.sbs');
            return redirect()->to($frontendUrl . '/portal/dashboard');

        }
        catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());

            $frontendUrl = env('FRONTEND_URL', 'https://ifuture.sbs');
            $errorMessage = urlencode($e->getMessage());
            return redirect()->to($frontendUrl . '/portal/login?error=Google_Auth_Failed&details=' . $errorMessage);
        }
    }
}
