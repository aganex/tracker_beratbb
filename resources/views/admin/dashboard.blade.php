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
                        <div class="stat-icon bg-primary-subtle text-primary">
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
                        <div class="stat-icon bg-info-subtle text-info">
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
                        <div class="stat-icon bg-pink-subtle">
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
        <div class="card" style="border-radius: 14px; overflow: hidden;">
            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-card-list me-2"></i> Daftar Akun
                </span>

                <form method="GET" class="position-relative" style="width: 300px;">
                    <i class="bi bi-search position-absolute"
                        style="left: 14px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input"
                        placeholder="Cari nama atau email...">
                </form>
            </div>

            <div class="card-body p-0">
                <div style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0 table-padded">
                        <thead class="table-light sticky-top">
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
                                            <span class="badge bg-light text-dark border fw-normal">
                                                {{ $user->jenis_kelamin }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->beratBadan->isNotEmpty())
                                            <span class="badge bg-primary-subtle text-primary fw-normal">
                                                {{ $user->beratBadan->last()->berat }} kg
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-sm btn-info">Chat</a>
                                            <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="/admin/user/{{ $user->id }}" method="POST"
                                                onsubmit="return confirm('Hapus akun {{ $user->name }}?\n\nSemua data riwayat berat badan milik akun ini akan ikut terhapus secara permanen dan tidak bisa dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
            .table-padded th,
            .table-padded td {
                padding-left: 20px;
                padding-right: 20px;
            }

            .table-padded th:first-child,
            .table-padded td:first-child {
                padding-left: 24px;
            }
        </style>

    </div>

@endsection