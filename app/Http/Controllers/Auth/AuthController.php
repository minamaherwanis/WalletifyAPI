<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequst;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $token = Str::random(length: 60);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'password' => bcrypt($data['password']),
            'country' => $data['country'] ?? null,
            'currency' => $data['currency'] ?? 'EGP',
            'email_verification_token' => $token,
        ]);

        Mail::to($user->email)->send(new VerifyEmailMail($user));

        return response()->json([
            'message' => 'Account created. Please check your email to verify.',
        ]);

    }

    public function verifyEmail(Request $request)
    {
        if ($request->token == null) {
            return view('auth.verify-failed');
        }

        $user = User::where('email_verification_token', $request->token)->first();
        if (! $user) {
            return view('auth.verify-failed');
        }

        DB::transaction(function () use ($user) {

            $user->update([
                'email_verified_at' => now(),
                'email_verification_token' => null,
            ]);

            if (! $user->wallet) {
                $user->wallet()->create([
                    'balance' => 0,
                    'currency' => $user->currency ?? 'EGP',
                ]);
            }
        });

        return view('auth.verify-success');

    }

    public function login(LoginRequst $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if (! $user->email_verified_at) {
            $token = Str::random(length: 60);
            $user->update([
                'email_verification_token' => $token,
            ]);

            Mail::to($user->email)->send(new VerifyEmailMail($user));

            return response()->json([
                'message' => 'Email not verified. We sent you a new verification link.',
            ], 403);
        }

        $user->tokens()->delete();
        $agent = $request->header('User-Agent');

        $token = $user->createToken($agent,
            ['*'],
            now()->addMinute(60))->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,

        ]);

    }
}
