<?php

namespace App\Http\Controllers;

use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /* ================= LOGIN ================= */
    public function showLogin()
    {
        return view('landingpage.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required',
        ]);

        // Bisa login pakai email atau username
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$field => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'Email/username atau password salah',
            ])->onlyInput('login');
        }

        $user = Auth::user();

        // Cek email sudah diverifikasi atau belum
        if (!$user->email_verified_at) {
            $email = $user->email;
            Auth::logout();

            session()->put('email', $email);

            return redirect()->route('verify.form')
                ->withErrors(['code' => 'Email belum diverifikasi. Masukkan kode OTP yang dikirim ke email kamu.']);
        }

        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('landingpage.home'));
    }

    /* ================= REGISTER ================= */
    public function showRegister()
    {
        return view('landingpage.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'username' => 'required|string|max:50|alpha_dash|unique:users,username',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:8',
        ]);

        $otp = $this->generateOtp();

        $user = User::create([
            ...$validated,
            'email_verification_code'       => $otp,
            'email_verification_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($user->name, $otp));

        session()->put('email', $user->email);

        // Langsung ke halaman verifikasi email
        return redirect()->route('verify.form')
            ->with('success', 'Kode OTP sudah dikirim ke email kamu.');
    }

    /* ================= FORM VERIFIKASI ================= */
    public function form()
    {
        if (!session()->has('email')) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session verifikasi habis, silakan daftar ulang.']);
        }

        return view('landingpage.verifikasiemail', [
            'email' => session('email'),
        ]);
    }

    /* ================= PROSES VERIFIKASI OTP ================= */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = session('email');

        if (!$email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session verifikasi habis, silakan daftar ulang.']);
        }

        $user = User::where('email', $email)
            ->where('email_verification_code', $request->code)
            ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Kode OTP salah.']);
        }

        if ($user->email_verification_expires_at?->isPast()) {
            return back()->withErrors(['code' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.']);
        }

        $user->forceFill([
            'email_verified_at'             => now(),
            'email_verification_code'       => null,
            'email_verification_expires_at' => null,
        ])->save();

        session()->forget('email');

        // Langsung loginkan setelah verifikasi
        Auth::login($user);
        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('landingpage.home')
            ->with('success', 'Email berhasil diverifikasi. Selamat datang!');
    }

    /* ================= RESEND OTP ================= */
    public function resendOtp(Request $request)
    {
        $email = session('email');

        if (!$email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session verifikasi habis, silakan daftar ulang.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('register');
        }

        if ($user->email_verified_at) {
            session()->forget('email');
            return redirect()->route('login')
                ->with('success', 'Email sudah diverifikasi. Silakan login.');
        }

        $otp = $this->generateOtp();

        $user->forceFill([
            'email_verification_code'       => $otp,
            'email_verification_expires_at' => now()->addMinutes(10),
        ])->save();

        Mail::to($user->email)->send(new OtpVerificationMail($user->name, $otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email kamu.');
    }

    /* ================= LOGOUT ================= */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function generateOtp(): string
    {
        return (string) random_int(100000, 999999);
    }
}