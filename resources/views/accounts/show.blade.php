@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">My Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" style="flex-grow: 0;" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/post">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/akun">Akun</a>
                </li>
                @if(session()->has('username'))
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endif
            </div>
        </div>
    </nav>
    <div class="p-5">
        <h1>Account Details</h1>
        <table class="table w-50">
            <tbody>
                <tr>
                    <th scope="row">Username</th>
                    <td>{{ $account->username }}</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $account->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Role</th>
                    <td>{{ $account->role }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection