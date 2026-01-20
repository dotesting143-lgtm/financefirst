<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CustomPasswordResetController extends Controller
{
    // 1. Show the "Forgot Password" Form
    public function createForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // 2. Handle the "Send Link" form submission
    public function storeForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
        ]);

        // Find user by BOTH email and username
        $user = User::where('email', $request->email)
                    ->where('username', $request->username)
                    ->first();

        if (! $user) {
            return back()->withErrors(['email' => 'We cannot find a user with that email and username.']);
        }

        // Manually generate token and send notification to ensure we target THIS specific user instance
        $token = Password::broker()->createToken($user);
        $user->sendPasswordResetNotification($token);

        return back()->with('status', 'We have emailed your password reset link!');
    }

    // 3. Show the "Reset Password" Form (Clicked from Email)
    public function create(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email,
            'username' => $request->username, // Pass username to the view
        ]);
    }

    // 4. Handle the actual Password Update
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // 1. Verify the Token against the Email (Standard Security)
        // Note: Tokens are tied to Email, not Username in the DB, so we validate email+token first.
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                // This callback runs if token is valid.
                // BUT: $user here might be the WRONG user if emails are duplicates.
                
                // SO: We ignore the passed $user and find the correct one by username.
                $actualUser = User::where('username', $request->username)
                                  ->where('email', $request->email)
                                  ->first();

                if ($actualUser) {
                    $this->resetPassword($actualUser, $password);
                }
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));
    }
}