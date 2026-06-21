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
        <div class="row mb-4 g-3">

            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary-subtle text-primary">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Berat</small>
                            <h4 class="mb-0">{{ $beratTerbaru->berat ?? '-' }} <span class="fs-6 text-muted">kg</span></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon bg-info-subtle text-info">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">BMI</small>
                            <h4 class="mb-0">{{ $bmi ?? '-' }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon bg-warning-subtle text-warning">
                            <i class="bi bi-fire"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Kalori</small>
                            <h4 class="mb-0">{{ $kaloriHarian ?? '-' }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon bg-success-subtle text-success">
                            <i class="bi bi-flag"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Target</small>
                            <h4 class="mb-0">{{ $user->target_berat ?? '-' }} <span class="fs-6 text-muted">kg</span></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- STAT CARDS -->

        <!-- INFORMASI TUBUH -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-person-lines-fill me-2"></i> Informasi Tubuh
                </span>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Tinggi Badan</span>
                        <span class="fw-medium">{{ $user->tinggi_badan ?? '-' }} cm</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Jenis Kelamin</span>
                        <span class="fw-medium">{{ $user->jenis_kelamin ?? '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Umur</span>
                        <span class="fw-medium">{{ $umur ?? '-' }} tahun</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block mb-1">Status BMI</span>
                        @if ($statusBMI === 'Normal')
                            <span class="badge bg-success-subtle text-success fw-normal px-2 py-1">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Kurus')
                            <span class="badge bg-warning-subtle text-warning fw-normal px-2 py-1">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Overweight')
                            <span class="badge bg-orange-subtle text-orange fw-normal px-2 py-1">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Obesitas')
                            <span class="badge bg-danger-subtle text-danger fw-normal px-2 py-1">{{ $statusBMI }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- INFORMASI TUBUH -->

        <!-- TARGET KALORI -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-bullseye me-2"></i> Target & Kalori
                </span>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <span class="text-muted small d-block">BMR</span>
                        <span class="fw-medium">{{ $bmr ?? '-' }} kcal</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Kalori Harian</span>
                        <span class="fw-medium">{{ $kaloriHarian ?? '-' }} kcal</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Target Berat</span>
                        <span class="fw-medium">{{ $user->target_berat ?? '-' }} kg</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted small d-block">Sisa Target</span>
                        <span class="fw-medium">{{ $sisaTarget ?? '-' }} kg</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- TARGET KALORI -->

        <!-- INPUT BERAT BADAN -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-plus-circle me-2"></i> Input Berat Badan
                </span>
            </div>
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
        <div class="card mb-4" style="overflow: hidden;">
            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-clock-history me-2"></i> Riwayat Berat Badan
                </span>
            </div>

            <div class="card-body p-0">
                <div style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0 table-padded">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th width="10%">No</th>
                                <th>Tanggal</th>
                                <th>Berat Badan</th>
                                <th>Selisih</th>
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
                                    <td>
                                        @if (isset($riwayat[$loop->index + 1]))
                                            @php
                                                $selisih = $item->berat - $riwayat[$loop->index + 1]->berat;
                                            @endphp

                                            @if ($selisih > 0)
                                                <span class="text-danger">
                                                    <i class="bi bi-arrow-up"></i> +{{ number_format($selisih, 1) }} kg
                                                </span>
                                            @elseif ($selisih < 0)
                                                <span class="text-success">
                                                    <i class="bi bi-arrow-down"></i> {{ number_format($selisih, 1) }} kg
                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    <i class="bi bi-dash"></i> 0.0 kg
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
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

        <!-- Grafik Berat Badan -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fs-5 fw-semibold">
                    <i class="bi bi-bar-chart-line me-2"></i> Grafik Berat Badan
                </span>
            </div>
            <div class="card-body">
                <canvas id="beratChart" height="100"></canvas>
            </div>
        </div>

        @include('layouts.user-chart')
        <!-- Grafik Berat Badan -->

    </div>


@endsection