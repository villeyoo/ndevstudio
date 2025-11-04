<?php
namespace App\Http\Controllers;

use App\Models\CustomUser;
use Illuminate\Http\Request;
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

    $user = \App\Models\CustomUser::where('username', $request->username)->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        \Illuminate\Support\Facades\Auth::login($user);

        // INTI-NYA DI SINI:
        return $user->role === 'owner'
            ? redirect()->route('dashboard')
            : redirect()->route('dashboardAdmin'); // anggap selain owner = admin
    }

    return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
}



    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
