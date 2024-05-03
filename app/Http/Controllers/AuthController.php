<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255'
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters'
        ]);



        $username = explode('@', $request->email)[0] . rand(1000, 9999);

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // dd($user);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:255'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.exists' => 'Email does not exist',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters'
        ]);

        $user = User::where('email', $request->email)->first();
        $isVerified = $user->email_verified_at != null ? true : false;

        if (!$isVerified) {
            toast('Please verify your email first', 'error');
            $request->user()->sendEmailVerificationNotification();
            return redirect()->route('verification.notice');
        }

        $isDataValid = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$isDataValid) {
            toast('Invalid email or password', 'error');
            return back();
        }

        toast('Login successfully', 'success');
        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        $isVerified = $user->email_verified_at != null ? true : false;

        if (!$isVerified) {
            toast('Please verify your email first', 'error');
            $request->user()->sendEmailVerificationNotification();
            return redirect()->route('verification.notice');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.exists' => 'Email does not exist'
        ]);
        $token = Str::random(60);

        PasswordResetToken::updateOrCreate([
            'email' => $request->email
        ], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        toast('Password reset link sent to your email, please check', 'success');
        return redirect()->route('forgot-password');
    }

    public function resetPassword(Request $request, $token)
    {
        $token = PasswordResetToken::where('token', $token)->first();

        if (!$token) {
            toast('Invalid token', 'error');
            return redirect()->route('login');
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPasswordPost(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8|max:255'
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters'
        ]);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            toast('Invalid token', 'error');
            return redirect()->route('login');
        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            toast('Invalid email', 'error');
            return redirect()->route('login');
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        $token->delete();

        toast('Password reset successfully', 'success');
        return redirect()->route('login');
    }
}
