<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private const RESEND_DELAY = 60; // detik
    private const CODE_TTL = 10;     // menit

    /* ===================== REGISTER ===================== */

    // GET /register
    public function register()
    {
        return view('auth.register');
    }

    // POST /prosesregister
    public function registerStore(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'alpha_dash', 'min:4', 'max:50', 'unique:users,username'],
            'phone'    => ['required', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $code = $this->generateCode();

        $user = User::create([
            'name'                    => $data['name'],
            'email'                   => $data['email'],
            'username'                => $data['username'],
            'no_telepon'              => $data['phone'],
            'password'                => $data['password'],
            'level'                   => '0',
            'verification_code'       => Hash::make($code),
            'verification_expires_at' => now()->addMinutes(self::CODE_TTL),
            'verification_sent_at'    => now(),
        ]);

        session(['verify_email' => $user->email]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user->name, $code));
        } catch (\Throwable $e) {
            report($e);

            // email gagal, jadi tombol kirim ulang langsung aktif
            $user->forceFill(['verification_sent_at' => null])->save();

            return redirect()->route('verification.notice')
                ->withErrors(['code' => 'Akun dibuat, tapi email gagal terkirim. Klik "Kirim ulang kode".']);
        }

        return redirect()->route('verification.notice')
            ->with('success', 'Kode verifikasi sudah dikirim ke email Anda.');
    }

    /* ===================== VERIFIKASI EMAIL ===================== */

    // GET /verifikasi
    public function verificationNotice(Request $request)
    {
        // dari login: /verifikasi?email=...
        if ($request->filled('email')) {
            session(['verify_email' => $request->query('email')]);
        }

        $email = session('verify_email');

        if (!$email) {
            return redirect()->route('register');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->forget('verify_email');
            return redirect()->route('register');
        }

        if ($user->hasVerifiedEmail()) {
            session()->forget('verify_email');
            return redirect()->route('login')->with('success', 'Email sudah terverifikasi. Silakan login.');
        }

        return view('auth.verify-email', [
            'email' => $user->email,
            'sisa'  => $this->sisaCooldown($user),
        ]);
    }

    // POST /verifikasi
    public function verificationVerify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code'  => ['required', 'digits:6'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Akun tidak ditemukan.']);
        }

        if ($user->hasVerifiedEmail()) {
            session()->forget('verify_email');
            return redirect()->route('login')->with('success', 'Email sudah terverifikasi. Silakan login.');
        }

        if (!$user->verification_code
            || !$user->verification_expires_at
            || $user->verification_expires_at->isPast()) {
            return back()->withErrors(['code' => 'Kode kadaluarsa. Klik "Kirim ulang kode".']);
        }

        if (!Hash::check($request->code, $user->verification_code)) {
            return back()->withErrors(['code' => 'Kode salah.']);
        }

        $user->forceFill([
            'email_verified_at'       => now(),
            'verification_code'       => null,
            'verification_expires_at' => null,
            'verification_sent_at'    => null,
        ])->save();

        session()->forget('verify_email');

        // langsung masuk, tanpa login lagi
        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Email terverifikasi. Selamat datang!');
    }

    // POST /verifikasi/kirim-ulang
    public function verificationResend(Request $request)
    {
        $email = session('verify_email', $request->input('email'));
        $user  = $email ? User::where('email', $email)->first() : null;

        if (!$user) {
            return redirect()->route('register');
        }

        if ($user->hasVerifiedEmail()) {
            session()->forget('verify_email');
            return redirect()->route('login')->with('success', 'Email sudah terverifikasi. Silakan login.');
        }

        session(['verify_email' => $user->email]);

        // jeda 60 detik, dicek di server
        $sisa = $this->sisaCooldown($user);
        if ($sisa > 0) {
            return redirect()->route('verification.notice')
                ->withErrors(['code' => "Tunggu {$sisa} detik sebelum kirim ulang."]);
        }

        $code = $this->generateCode();

        // kirim dulu. Kalau gagal, kode lama dan cooldown tidak berubah
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user->name, $code));
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('verification.notice')
                ->withErrors(['code' => 'Email gagal terkirim. Coba lagi sebentar.']);
        }

        $user->forceFill([
            'verification_code'       => Hash::make($code),
            'verification_expires_at' => now()->addMinutes(self::CODE_TTL),
            'verification_sent_at'    => now(),
        ])->save();

        return redirect()->route('verification.notice')
            ->with('success', 'Kode baru sudah dikirim. Kode lama tidak berlaku lagi.');
    }

    /* ===================== LOGIN ===================== */

    // GET /login
    public function login()
    {
        return view('auth.login');
    }

    // POST /proseslogin
    // Form boleh pakai name="login", "email", atau "username" untuk isian akun.
    // Isian bisa email atau username. Password pakai name="password".
    public function loginStore(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $identifier = trim((string) (
            $request->input('login')
            ?? $request->input('email')
            ?? $request->input('username')
        ));

        if ($identifier === '') {
            return back()
                ->withErrors(['login' => 'Email atau username wajib diisi.'])
                ->withInput($request->only('login', 'email', 'username'));
        }

        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user  = User::where($field, $identifier)->first();

        // user Google/GitHub tidak punya password, jadi tidak bisa login lewat sini
        if (!$user || !$user->password || !Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['login' => 'Email/username atau password salah.'])
                ->withInput($request->only('login', 'email', 'username'));
        }

        // belum verifikasi email
        if (!$user->hasVerifiedEmail()) {
            session(['verify_email' => $user->email]);

            return redirect()->route('verification.notice')
                ->withErrors(['code' => 'Verifikasi email dulu. Klik "Kirim ulang kode" kalau kode belum ada.']);
        }

        Auth::guard('web')->login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    // POST /logout (route belum ada, tambah kalau perlu)
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* ===================== HELPER ===================== */

    private function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    // sisa detik sebelum boleh kirim ulang
    private function sisaCooldown(User $user): int
    {
        if (!$user->verification_sent_at) {
            return 0;
        }

        $lewat = now()->timestamp - $user->verification_sent_at->timestamp;

        return max(0, self::RESEND_DELAY - $lewat);
    }
}