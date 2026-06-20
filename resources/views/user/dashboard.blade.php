@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">

        <!-- HEADER -->
        @include('components.header')
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

        <!-- STAT CARDS -->
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">Berat</small>
                        <h3>{{ $beratTerbaru->berat ?? '-' }} kg</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">BMI</small>
                        <h3>{{ $bmi ?? '-' }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">Kalori</small>
                        <h3>{{ $kaloriHarian ?? '-' }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <small class="text-muted">Target</small>
                        <h3>{{ $user->target_berat ?? '-' }} kg</h3>
                    </div>
                </div>
            </div>

        </div>
        <!-- STAT CARDS -->

        <!-- INFORMASI TUBUH -->
        <div class="card mb-4">
            <div class="card-header">Informasi Tubuh</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">Tinggi Badan : {{ $user->tinggi_badan ?? '-' }} cm</div>
                    <div class="col-md-6">Jenis Kelamin : {{ $user->jenis_kelamin ?? '-' }}</div>
                    <div class="col-md-6 mt-3">Umur : {{ $umur ?? '-' }} tahun</div>
                    <div class="col-md-6 mt-3">Status BMI : {{ $statusBMI ?? '-' }}</div>
                </div>
            </div>
        </div>
        <!-- INFORMASI TUBUH -->

        <!-- TARGET KALORI -->
        <div class="card mb-4">
            <div class="card-header">Target & Kalori</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">BMR : {{ $bmr ?? '-' }} kcal</div>
                    <div class="col-md-6">Kalori Harian : {{ $kaloriHarian ?? '-' }} kcal</div>
                    <div class="col-md-6 mt-3">Target Berat : {{ $user->target_berat ?? '-' }} kg</div>
                    <div class="col-md-6 mt-3">Sisa Target : {{ $sisaTarget ?? '-' }} kg</div>
                </div>
            </div>
        </div>
        <!-- TARGET KALORI -->

        <!-- INPUT BERAT BADAN -->
        <div class="card mb-4">
            <div class="card-header">Input Berat Badan</div>
            <div class="card-body">
                <form method="POST" action="/berat-badan">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="berat" value="{{ old('berat') }}"
                            class="form-control @error('berat') is-invalid @enderror" placeholder="Contoh: 75.5">
                        @error('berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                            class="form-control @error('tanggal') is-invalid @enderror">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Berat Badan</button>
                </form>
            </div>
        </div>
        <!-- INPUT BERAT BADAN -->

        <!-- RIWAYAT BB -->
        <div class="card mb-4">
            <div class="card-header">Riwayat Berat Badan</div>
            <div class="card-body p-0">
                <div style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th width="10%">No</th>
                                <th>Tanggal</th>
                                <th>Berat Badan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayat as $item)
                                <tr @if ($loop->first) class="border-start border-3 border-primary" @endif>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="bi bi-calendar3 text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary fw-normal">{{ $item->berat }} kg</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <i class="bi bi-clipboard-data fs-1 d-block mb-2 opacity-50"></i>
                                        Belum ada data berat badan<br>
                                        <small>Catat berat badan pertamamu di form atas</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- RIWAYAT BB -->

    </div>
@endsection