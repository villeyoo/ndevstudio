<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    Log::info('Login attempt', ['username' => $request->username, 'ip' => $request->ip()]);

    // Cari user
    $user = \App\Models\CustomUser::where('username', $request->username)->first();

    if (! $user) {
        Log::warning('Login failed: user not found', ['username' => $request->username]);
        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    // Cek hash password
    if (! Hash::check($request->password, $user->password)) {
        Log::warning('Login failed: wrong password', ['username' => $request->username, 'user_id' => $user->id]);
        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    // Login & regenerate session
    Auth::login($user);
    $request->session()->regenerate();

    Log::info('Login success', ['username' => $request->username, 'user_id' => $user->id, 'role' => $user->role]);

    // Redirect sesuai role
    if ($user->role === 'owner') {
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    return redirect()->route('dashboardAdmin')->with('success', 'Login berhasil!');
}



    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
