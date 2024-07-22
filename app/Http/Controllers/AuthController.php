<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $account = Account::where('username', $request->username)->first();

        if ($account && Hash::check($request->password, $account->password)) {
            $request->session()->put('username', $account->username);
            return redirect()->intended('/'); 
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function showAccounts(Request $request)
    {
        if ($request->session()->has('username')) {
            $accounts = Account::all();
            return view('accounts.index', compact('accounts'));
        }

        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('username');
        return redirect('/');
    }
}
