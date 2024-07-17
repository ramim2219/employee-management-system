<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        $credentials = $request->only('email', 'password', 'token');

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Password has been reset!'))
            : back()->withErrors(['email' => __('Email not found.')]);
    }
}
