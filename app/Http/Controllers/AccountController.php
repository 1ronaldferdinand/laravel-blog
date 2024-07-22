<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('username')) {
            $accounts = Account::all();
            return view('accounts.index', compact('accounts'));
        }

        return view('auth.login');
    }

    public function create(Request $request)
    {
        if ($request->session()->has('username')) {
            return view('accounts.create');
        }

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:45|unique:account',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:45',
            'role' => 'required|string|max:45',
        ]);

        Account::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    public function show(Request $request, $username)
    {
        if ($request->session()->has('username')) {
            $account = Account::where('username', $username)->first();
            return view('accounts.show', compact('account'));
        }

        return view('auth.login');
    }

    public function edit(Request $request, $username)
    {
        if ($request->session()->has('username')) {
            $account = Account::where('username', $username)->first();
            return view('accounts.edit', compact('account'));
        }

        return view('auth.login');
    }

    public function update(Request $request, $username)
    {
        $request->validate([
            'password' => 'nullable|string|min:6',
            'name' => 'required|string|max:45',
            'role' => 'required|string|max:45',
        ]);

        $account = Account::where('username', $username)->first();
        $account->name = $request->name;
        $account->role = $request->role;

        if ($request->filled('password')) {
            $account->password = Hash::make($request->password);
        }

        $account->save();

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(Request $request, $username)
    {
        if ($request->session()->has('username')) {
            $account = Account::where('username', $username)->first();
            $account->delete();
    
            return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
        }

        return view('auth.login');
    }
}
