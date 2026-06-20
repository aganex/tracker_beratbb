@extends('layouts.auth')
@section('title', 'Register')
@section('content')

    <h5 class="auth-title mb-4">
        Buat akun baru
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                placeholder="Nama lengkap"
                required
            >
        </div>

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
            Register
        </button>
    </form>

    <div class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
        Sudah punya akun?
        <a href="/login" class="auth-link">Login</a>
    </div>

@endsection