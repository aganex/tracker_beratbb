@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container py-4">

        {{-- HEADER ADMIN --}}
        @include('components.admin-header')
        {{-- HEADER ADMIN --}}

        {{-- STATISTIK USER --}}
        <div class="row mb-4 g-3">

            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon stat-icon--blue">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total User</small>
                            <h3 class="mb-0">{{ $totalUser }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon stat-icon--cyan">
                            <i class="bi bi-gender-male"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Pria</small>
                            <h3 class="mb-0">{{ $totalPria }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon stat-icon--pink">
                            <i class="bi bi-gender-female"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Wanita</small>
                            <h3 class="mb-0">{{ $totalWanita }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- STATISTIK USER --}}

        <!-- DAFTAR AKUN -->
        <div class="account-card">
            <div class="account-card__head">
                <span class="account-card__title">
                    <i class="bi bi-card-list me-2"></i> Daftar Akun
                </span>

                <form method="GET" class="search-form">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                        placeholder="Cari nama atau email...">
                </form>
            </div>

            <div class="account-card__body">
                <div class="table-scroll">
                    <table class="table table-hover align-middle mb-0 table-padded">
                        <thead class="sticky-top">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>BB Terakhir</th>
                                <th width="22%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                    <td>
                                        @if ($user->jenis_kelamin)
                                            <span class="pill pill--neutral">
                                                {{ $user->jenis_kelamin }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->beratBadan->isNotEmpty())
                                            <span class="pill pill--accent">
                                                {{ $user->beratBadan->last()->berat }} kg
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="/admin/user/{{ $user->id }}/chat" class="action-btn action-btn--chat">Chat</a>
                                            <a href="/admin/user/{{ $user->id }}/edit"
                                                class="action-btn action-btn--edit">Edit</a>
                                            <form action="/admin/user/{{ $user->id }}" method="POST"
                                                onsubmit="return confirm('Hapus akun {{ $user->name }}?\n\nSemua data riwayat berat badan milik akun ini akan ikut terhapus secara permanen dan tidak bisa dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn action-btn--delete">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                        Tidak ada data user
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- DAFTAR AKUN -->

        <style>
            .stat-card {
                border: 1px solid #eef1f6;
                border-radius: 16px;
                box-shadow: 0 4px 24px rgba(20, 40, 80, 0.05);
            }

            .stat-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.1rem;
                flex-shrink: 0;
            }

            .stat-icon--blue {
                background: linear-gradient(135deg, rgba(28, 163, 224, 0.12), rgba(99, 102, 241, 0.12));
                color: #1ca3e0;
            }

            .stat-icon--cyan {
                background: rgba(13, 202, 240, 0.12);
                color: #0dcaf0;
            }

            .stat-icon--pink {
                background: rgba(214, 51, 132, 0.1);
                color: #d63384;
            }

            .account-card {
                background: #ffffff;
                border: 1px solid #eef1f6;
                border-radius: 18px;
                box-shadow: 0 4px 24px rgba(20, 40, 80, 0.06);
                overflow: hidden;
            }

            .account-card__head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 18px 24px;
                border-bottom: 1px solid #eef1f6;
                background: #ffffff;
                flex-wrap: wrap;
                gap: 12px;
            }

            .account-card__title {
                font-size: 1.02rem;
                font-weight: 700;
                color: #1a2233;
            }

            .account-card__title i {
                color: #1ca3e0;
            }

            .search-form {
                position: relative;
                width: 300px;
            }

            .search-icon {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: #aab2c0;
                font-size: 0.85rem;
            }

            .search-input {
                width: 100%;
                border: 1px solid #eef1f6;
                background: #f8fafc;
                border-radius: 10px;
                padding: 9px 14px 9px 36px;
                font-size: 0.85rem;
                outline: none;
                transition: border-color 0.15s ease;
            }

            .search-input:focus {
                border-color: #1ca3e0;
                background: #ffffff;
            }

            .table-scroll {
                max-height: 500px;
                overflow-y: auto;
            }

            .table-padded th,
            .table-padded td {
                padding-left: 20px;
                padding-right: 20px;
            }

            .table-padded th:first-child,
            .table-padded td:first-child {
                padding-left: 24px;
            }

            .table-padded thead th {
                background: #f8fafc;
                color: #5b6577;
                font-size: 0.78rem;
                font-weight: 600;
                letter-spacing: .02em;
                text-transform: uppercase;
                border-bottom: 1px solid #eef1f6;
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .table-padded tbody td {
                font-size: 0.88rem;
                border-bottom: 1px solid #f3f5f9;
            }

            .user-avatar-sm {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: linear-gradient(135deg, #e8f4fc, #eef0fd);
                color: #1ca3e0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 0.78rem;
                flex-shrink: 0;
            }

            .pill {
                font-size: 0.76rem;
                font-weight: 600;
                padding: 5px 12px;
                border-radius: 999px;
                white-space: nowrap;
            }

            .pill--neutral {
                background: #f1f3f8;
                color: #5b6577;
            }

            .pill--accent {
                background: linear-gradient(135deg, rgba(28, 163, 224, 0.12), rgba(99, 102, 241, 0.12));
                color: #1ca3e0;
            }

            .action-btn {
                font-size: 0.78rem;
                font-weight: 600;
                padding: 6px 12px;
                border-radius: 8px;
                border: none;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                transition: opacity 0.15s ease;
            }

            .action-btn:hover {
                opacity: 0.85;
            }

            .action-btn--chat {
                background: #eaf6fd;
                color: #1ca3e0;
            }

            .action-btn--edit {
                background: #fff4e0;
                color: #c9821a;
            }

            .action-btn--delete {
                background: #fde8e8;
                color: #d64545;
            }

            @media (max-width: 576px) {
                .search-form {
                    width: 100%;
                }
            }
        </style>

    </div>

@endsection