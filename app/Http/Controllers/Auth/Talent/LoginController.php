<?php

namespace App\Http\Controllers\Auth\Talent;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.talent.login');
    }

    public function login(Request $request) {
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required'
        ]);

        if(Auth::guard('talent')->attempt($request->only('phone', 'password'))) {
            $talent = Auth::guard('talent')->user();

            if($talent->status != Talent::STATUS_APPROVED) {
                Auth::guard('talent')->logout();

                return back()->with('error', 'Akun anda belum aktif, Mohon untuk melakukan kontak kepada admin');
            }

            $request->session()->regenerate();

            return redirect()->intended('talent/schedule');
        }

        return back()->with('error', 'Gagal melakukan login, Check kembali nomor & password kamu');
    }

    public function logout(Request $request)
    {
        Auth::guard('talent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/talent/logins')->with('success', 'Berhasil logout');
    }
}
