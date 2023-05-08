<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.Login');
    }
    public function store()
    {
        $login = request()->validate([
            'nis' => 'required',
            'password' => 'required'
        ]);

        $email = [
            'email' => $login['nis'],
            'password' => $login['password'],
        ];



        if (Auth::attempt($login, request('remembered'))) {
            request()->session()->regenerate();

            return redirect()->intended('/');
        }
        if (Auth::attempt($email, request('remembered'))) {
            request()->session()->regenerate();

            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'NIS atau Password anda salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function verifyEmail()
    {
        return view('Auth.VerifyEmail');
    }

    public function verifyEmailSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
    public function verificationEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->intended('/');
    }

    public function forgetPassword()
    {
        return view('Auth.ForgetPassword');
    }
    public function forgetPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(string $token)
    {
        return view('Auth.ResetPassword', ['token' => $token]);
    }

    public function resetPasswordStore(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // dd($request);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
