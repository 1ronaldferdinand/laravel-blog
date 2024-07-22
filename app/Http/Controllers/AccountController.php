<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
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

    public function show($username)
    {
        $account = Account::where('username', $username)->first();
        return view('accounts.show', compact('account'));
    }

    public function edit($username)
    {
        $account = Account::where('username', $username)->first();
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, $username)
    {
        $request->validate([
            'password' => 'nullable|string|min:6',
            'name' => 'required|string|max:45',
            'role' => 'required|string|max:45',
        ]);

        $account = Account::findOrFail($username);
        $account->name = $request->name;
        $account->role = $request->role;

        if ($request->filled('password')) {
            $account->password = Hash::make($request->password);
        }

        $account->save();

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    public function destroy($username)
    {
        $account = Account::findOrFail($username);
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }
}
