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
            <div class="card-header">Grafik Berat Badan</div>
            <div class="card-body">
                <canvas id="beratChart" height="100"></canvas>
            </div>
        </div>

        <script>
            window.onload = function () {
                const labels = [
                    @foreach ($riwayatGrafik as $item)
                        '{{ \Carbon\Carbon::parse($item->tanggal)->format('d M') }}',
                    @endforeach
                ];

                const dataBerat = [
                    @foreach ($riwayatGrafik as $item)
                        {{ $item->berat }},
                    @endforeach
                ];

                const targetBerat = {{ $user->target_berat ?? 'null' }};

                // =====================================================
                // CARI INDEX NILAI TERTINGGI & TERENDAH
                // =====================================================
                const maxValue = Math.max(...dataBerat);
                const minValue = Math.min(...dataBerat);

                const pointColors = dataBerat.map(function (berat) {
                    if (berat === maxValue) return '#dc3545';
                    if (berat === minValue) return '#198754';
                    return '#1ca3e0';
                });

                const pointRadiuses = dataBerat.map(function (berat) {
                    return (berat === maxValue || berat === minValue) ? 6 : 4;
                });

                // =====================================================
                // GRADIENT FILL
                // =====================================================
                const ctx = document.getElementById('beratChart');
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 250);
                gradient.addColorStop(0, 'rgba(28, 163, 224, 0.35)');
                gradient.addColorStop(1, 'rgba(28, 163, 224, 0.02)');

                // =====================================================
                // SUSUN DATASET
                // =====================================================
                const datasets = [{
                    label: 'Berat Badan (kg)',
                    data: dataBerat,
                    borderColor: '#1ca3e0',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: pointColors,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: pointRadiuses,
                    pointHoverRadius: 7
                }];

                if (targetBerat) {
                    datasets.push({
                        label: 'Target Berat (kg)',
                        data: labels.map(function () { return targetBerat; }),
                        borderColor: '#6c757d',
                        borderWidth: 2,
                        borderDash: [6, 6],
                        pointRadius: 0,
                        fill: false
                    });
                }

                // =====================================================
                // RENDER CHART
                // =====================================================
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    boxWidth: 8
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        if (context.dataset.label === 'Target Berat (kg)') {
                                            return 'Target: ' + context.parsed.y + ' kg';
                                        }

                                        const index = context.dataIndex;
                                        const beratSekarang = dataBerat[index];
                                        const beratSebelumnya = index > 0 ? dataBerat[index - 1] : null;

                                        let label = 'Berat: ' + beratSekarang + ' kg';

                                        if (beratSebelumnya !== null) {
                                            const selisih = (beratSekarang - beratSebelumnya).toFixed(1);
                                            const tanda = selisih > 0 ? '+' : '';
                                            label += ' (' + tanda + selisih + ' kg dari sebelumnya)';
                                        }

                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        }
                    }
                });
            };
        </script>
        <!-- Grafik Berat Badan -->

    </div>
@endsection