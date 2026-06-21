@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="container py-4">

        {{-- HEADER ADMIN --}}
        @include('components.admin-header')

        {{-- JUDUL --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="edit-title">Edit Akun</h3>
                <p class="edit-subtitle">Kelola informasi akun pengguna</p>
            </div>
            <a href="/admin" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert-card mb-4">
                <i class="bi bi-exclamation-circle-fill alert-card__icon"></i>
                <ul class="alert-card__list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-3">

            {{-- FORM EDIT --}}
            <div class="col-lg-7">
                <div class="panel-card">
                    <div class="panel-card__head">Informasi Akun</div>
                    <div class="panel-card__body">
                        <form action="/admin/user/{{ $user->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- NAMA --}}
                            <div class="field mb-3">
                                <label class="field-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="field-input">
                            </div>

                            {{-- EMAIL --}}
                            <div class="field mb-3">
                                <label class="field-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="field-input">
                            </div>

                            {{-- PASSWORD BARU --}}
                            <div class="field mb-3">
                                <label class="field-label">Password Baru</label>
                                <input type="password" name="password"
                                    class="field-input @error('password') field-input--error @enderror"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- KONFIRMASI PASSWORD --}}
                            <div class="field mb-4">
                                <label class="field-label">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="field-input">
                            </div>

                            {{-- ROLE --}}
                            <div class="field mb-3">
                                <label class="field-label">Role</label>
                                <select name="role" class="field-select">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            {{-- JENIS KELAMIN --}}
                            <div class="field mb-4">
                                <label class="field-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="field-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <button type="submit" class="submit-btn">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- INFORMASI USER --}}
            <div class="col-lg-5">
                <div class="panel-card">
                    <div class="panel-card__head">Informasi User</div>
                    <div class="panel-card__body">

                        <div class="info-row">
                            <span class="info-row__icon"><i class="bi bi-calendar3"></i></span>
                            <div>
                                <small class="info-row__label">Tanggal Daftar</small>
                                <div class="info-row__value">{{ $user->created_at?->format('d M Y') ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-row__icon"><i class="bi bi-rulers"></i></span>
                            <div>
                                <small class="info-row__label">Tinggi Badan</small>
                                <div class="info-row__value">{{ $user->tinggi_badan ?? '-' }} cm</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-row__icon"><i class="bi bi-bullseye"></i></span>
                            <div>
                                <small class="info-row__label">Target Berat</small>
                                <div class="info-row__value">{{ $user->target_berat ?? '-' }} kg</div>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-row__icon"><i class="bi bi-activity"></i></span>
                            <div>
                                <small class="info-row__label">Aktivitas</small>
                                <div class="info-row__value">{{ $user->aktivitas ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="info-row info-row--highlight">
                            <span class="info-row__icon info-row__icon--accent"><i class="bi bi-graph-down"></i></span>
                            <div>
                                <small class="info-row__label">Berat Terakhir</small>
                                <div class="info-row__value">
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

    </div>

    <style>
        .edit-title {
            font-weight: 700;
            color: #1a2233;
            margin-bottom: 2px;
        }

        .edit-subtitle {
            color: #8a93a3;
            margin: 0;
            font-size: 0.88rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #5b6577;
            background: #f1f3f8;
            padding: 9px 16px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.15s ease, color 0.15s ease;
            white-space: nowrap;
        }

        .back-link:hover {
            background: #e6e9f0;
            color: #1a2233;
        }

        .alert-card {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: #fdecec;
            border: 1px solid #f7d3d3;
            border-radius: 14px;
            padding: 16px 18px;
            color: #b33636;
        }

        .alert-card__icon {
            font-size: 1.1rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .alert-card__list {
            margin: 0;
            padding-left: 18px;
            font-size: 0.88rem;
        }

        .panel-card {
            background: #ffffff;
            border: 1px solid #eef1f6;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(20, 40, 80, 0.06);
            overflow: hidden;
            height: 100%;
        }

        .panel-card__head {
            padding: 18px 24px;
            border-bottom: 1px solid #eef1f6;
            font-weight: 700;
            font-size: 0.95rem;
            color: #1a2233;
        }

        .panel-card__body {
            padding: 24px;
        }

        .field-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #5b6577;
            margin-bottom: 6px;
        }

        .field-input,
        .field-select {
            width: 100%;
            border: 1px solid #eef1f6;
            background: #f8fafc;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            color: #1a2233;
            outline: none;
            transition: border-color 0.15s ease, background 0.15s ease;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: #1ca3e0;
            background: #ffffff;
        }

        .field-input--error {
            border-color: #d64545;
            background: #fdecec;
        }

        .field-error {
            font-size: 0.78rem;
            color: #d64545;
            margin-top: 5px;
        }

        .field-input::placeholder {
            color: #aab2c0;
        }

        .submit-btn {
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #1ca3e0, #6366f1);
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 11px 24px;
            transition: opacity 0.15s ease;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-row__icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f1f3f8;
            color: #5b6577;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .info-row__icon--accent {
            background: linear-gradient(135deg, rgba(28,163,224,0.12), rgba(99,102,241,0.12));
            color: #1ca3e0;
        }

        .info-row__label {
            color: #8a93a3;
            font-size: 0.78rem;
        }

        .info-row__value {
            font-weight: 600;
            font-size: 0.92rem;
            color: #1a2233;
        }

        .info-row--highlight .info-row__value {
            color: #1ca3e0;
        }
    </style>
@endsection