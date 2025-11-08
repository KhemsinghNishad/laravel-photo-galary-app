<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\PasswordResetMail;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();      

        // Do not reveal whether email exists
        if (! $user) {
            return back()->with('status', 'A reset link has been sent if the email exists.');
        }

        $plainToken = Str::random(64);
        $hashedToken = Hash::make($plainToken);

        DB::table('password_reset')->where('email', $user->email)->delete();

        DB::table('password_reset')->insert([
            'email' => $user->email,
            'token' => $hashedToken,
            'created_at' => Carbon::now(),
        ]);

        Mail::to($user->email)->send(new PasswordResetMail($plainToken, $user));

        return back()->with('status', 'A reset link has been sent if the email exists.');
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_reset')->where('email', $request->email)->first();

        if (! $record) {
            return back()->withErrors(['email' => 'Invalid or expired reset request.']);
        }

        $created = Carbon::parse($record->created_at);
        if ($created->addMinutes(60)->isPast()) {
            DB::table('password_reset')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Reset link expired.']);
        }

        if (! Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'User does not exist.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully. You may now login.');
    }
}
