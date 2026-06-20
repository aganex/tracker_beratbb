@extends('layouts.auth')
@section('title', 'Login')
@section('content')

    <h5 class="auth-title mb-4">
        Masuk ke akun anda
    </h5>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
            >
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="••••••••"
                required
            >
        </div>

        <button
            type="submit"
            class="btn btn-auth text-white w-100"
        >
            Masuk
        </button>
    </form>


    <div class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
        Belum punya akun?
        <a href="/register" class="auth-link">Register</a>
    </div>

@endsection