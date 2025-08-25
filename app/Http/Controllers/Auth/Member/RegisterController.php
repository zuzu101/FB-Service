<?php

namespace App\Http\Controllers\Auth\Member;

use App\Http\Controllers\Controller;
use App\Services\MasterData\MemberService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.member.register');
    }

    public function store(Request $request, MemberService $memberService)
    {
        $memberService->store($request);

        return redirect()->route('member.auth.login.index')->with('success', 'Berhasil mendaftar menjadi member');
    }
}
