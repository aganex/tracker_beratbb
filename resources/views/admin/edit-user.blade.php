@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

    <div class="container py-4">

        {{-- HEADER ADMIN --}}
        @include('components.admin-header')

        {{-- JUDUL --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="mb-1">Edit Akun</h3>

                <p class="text-muted mb-0">
                    Kelola informasi akun pengguna
                </p>

            </div>

            <a href="/admin" class="btn btn-outline-secondary">
                Kembali
            </a>

        </div>

        <div class="row">

            {{-- FORM EDIT --}}
            <div class="col-lg-7">

                <div class="card">

                    <div class="card-header">

                        Informasi Akun

                    </div>

                    <div class="card-body">

                        <form action="/admin/user/{{ $user->id }}" method="POST">

                            @csrf
                            @method('PUT')

                            {{-- NAMA --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Nama
                                </label>

                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">

                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control">

                            </div>

                            {{-- ROLE --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Role
                                </label>

                                <select name="role" class="form-select">

                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                </select>

                            </div>

                            {{-- JENIS KELAMIN --}}
                            <div class="mb-4">

                                <label class="form-label">
                                    Jenis Kelamin
                                </label>

                                <select name="jenis_kelamin" class="form-select">

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>

                                    <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>

                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- INFORMASI USER --}}
            <div class="col-lg-5">

                <div class="card">

                    <div class="card-header">

                        Informasi User

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <small class="text-muted">
                                Tanggal Daftar
                            </small>

                            <div class="fw-semibold">
                                {{ $user->created_at?->format('d M Y') ?? '-' }}
                            </div>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted">
                                Tinggi Badan
                            </small>

                            <div class="fw-semibold">
                                {{ $user->tinggi_badan ?? '-' }} cm
                            </div>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted">
                                Target Berat
                            </small>

                            <div class="fw-semibold">
                                {{ $user->target_berat ?? '-' }} kg
                            </div>

                        </div>

                        <div class="mb-3">

                            <small class="text-muted">
                                Aktivitas
                            </small>

                            <div class="fw-semibold">
                                {{ $user->aktivitas ?? '-' }}
                            </div>

                        </div>

                        <div>

                            <small class="text-muted">
                                Berat Terakhir
                            </small>

                            <div class="fw-semibold">

                                @if ($user->beratBadan->isNotEmpty())
                                    {{ $user->beratBadan->last()->berat }} kg
                                @else
                                    -
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection