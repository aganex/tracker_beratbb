@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4 header-card">
            <div class="d-flex align-items-center">
                <img
                    src="{{ asset('images/logoH.png') }}"
                    alt="Tracker BB"
                    height="44"
                    class="me-3"
                >

                <div class="vr me-3 d-none d-sm-block" style="height: 36px; opacity: 0.15;"></div>

                <div class="d-flex align-items-center">
                    <div class="user-avatar me-3">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-muted mb-0 small">Edit Profile</p>
                        <h5 class="mb-0 fw-semibold">{{ $user->name }}</h5>
                    </div>
                </div>
            </div>

            <a href="/dashboard" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <!-- HEADER -->

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM DATA PROFILE -->
        <div class="card">
            <div class="card-header">Data Profile</div>
            <div class="card-body">
                <form method="POST" action="/profile">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $user->tinggi_badan) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Target Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="target_berat" value="{{ old('target_berat', $user->target_berat) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Aktivitas Harian</label>
                        <select name="aktivitas" class="form-select">
                            <option value="">-- Pilih Aktivitas --</option>
                            <option value="Tidak Aktif" {{ $user->aktivitas == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="Ringan" {{ $user->aktivitas == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                            <option value="Sedang" {{ $user->aktivitas == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Aktif" {{ $user->aktivitas == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Sangat Aktif" {{ $user->aktivitas == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Profile</button>
                </form>
            </div>
        </div>
        <!-- FORM DATA PROFILE -->

    </div>

    <style>
        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1ca3e0, #0a4d68);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
    </style>
@endsection