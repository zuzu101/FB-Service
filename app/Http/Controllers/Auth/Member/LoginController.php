<?php

namespace App\Http\Controllers\Auth\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.member.login');
    }

    public function login(Request $request) {
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required'
        ]);

        if(Auth::guard('member')->attempt($request->only('phone', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('member/profiles');
        }

        return back()->with('error', 'Gagal melakukan login, Check kembali nomor & password kamu');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/member/logins')->with('success', 'Berhasil logout');
    }
}
