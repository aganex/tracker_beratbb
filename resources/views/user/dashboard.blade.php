@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">

        <!-- HEADER -->
        @include('components.header')
        <!-- HEADER -->

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert-card alert-card--success mb-4">
                <i class="bi bi-check-circle-fill alert-card__icon"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert-card alert-card--danger mb-4">
                <i class="bi bi-exclamation-circle-fill alert-card__icon"></i>
                <ul class="alert-card__list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- STAT CARDS -->
        <div class="row mb-4 g-3">

            <div class="col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="stat-card__icon stat-card__icon--blue">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div>
                        <small class="stat-card__label">Berat</small>
                        <h4 class="stat-card__value">{{ $beratTerbaru->berat ?? '-' }} <span class="stat-card__unit">kg</span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="stat-card__icon stat-card__icon--cyan">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <div>
                        <small class="stat-card__label">BMI</small>
                        <h4 class="stat-card__value">{{ $bmi ?? '-' }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="stat-card__icon stat-card__icon--purple">
                        <i class="bi bi-rulers"></i>
                    </div>
                    <div>
                        <small class="stat-card__label">Berat Ideal</small>
                        <h4 class="stat-card__value">{{ $beratIdeal ?? '-' }} <span class="stat-card__unit">kg</span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="stat-card__icon stat-card__icon--orange">
                        <i class="bi bi-fire"></i>
                    </div>
                    <div>
                        <small class="stat-card__label">Kalori</small>
                        <h4 class="stat-card__value">{{ $kaloriHarian ?? '-' }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="stat-card__icon stat-card__icon--green">
                        <i class="bi bi-flag"></i>
                    </div>
                    <div>
                        <small class="stat-card__label">Target</small>
                        <h4 class="stat-card__value">{{ $user->target_berat ?? '-' }} <span class="stat-card__unit">kg</span></h4>
                    </div>
                </div>
            </div>

        </div>
        <!-- STAT CARDS -->

        <!-- INFORMASI TUBUH -->
        <div class="panel-card mb-4">
            <div class="panel-card__head">
                <i class="bi bi-person-lines-fill me-2"></i> Informasi Tubuh
            </div>
            <div class="panel-card__body">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <span class="info-label">Tinggi Badan</span>
                        <span class="info-value">{{ $user->tinggi_badan ?? '-' }} cm</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value">{{ $user->jenis_kelamin ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Umur</span>
                        <span class="info-value">{{ $umur ?? '-' }} tahun</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Berat Ideal (Devine)</span>
                        <span class="info-value">{{ $beratIdeal ?? '-' }} kg</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label d-block mb-1">Status BMI</span>
                        @if ($statusBMI === 'Normal')
                            <span class="pill pill--green">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Kurus')
                            <span class="pill pill--orange">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Overweight')
                            <span class="pill pill--orange">{{ $statusBMI }}</span>
                        @elseif ($statusBMI === 'Obesitas')
                            <span class="pill pill--red">{{ $statusBMI }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- INFORMASI TUBUH -->

        <!-- TARGET KALORI -->
        <div class="panel-card mb-4">
            <div class="panel-card__head">
                <i class="bi bi-bullseye me-2"></i> Target & Kalori
            </div>
            <div class="panel-card__body">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <span class="info-label">BMR</span>
                        <span class="info-value">{{ $bmr ?? '-' }} kcal</span>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Kalori Harian</span>
                        <span class="info-value">{{ $kaloriHarian ?? '-' }} kcal</span>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Target Berat</span>
                        <span class="info-value">{{ $user->target_berat ?? '-' }} kg</span>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Sisa Target</span>
                        <span class="info-value">{{ $sisaTarget ?? '-' }} kg</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- TARGET KALORI -->

        <!-- INPUT BERAT BADAN -->
        <div class="panel-card mb-4">
            <div class="panel-card__head">
                <i class="bi bi-plus-circle me-2"></i> Input Berat Badan
            </div>
            <div class="panel-card__body">
                <form method="POST" action="/berat-badan">
                    @csrf

                    <div class="field mb-3">
                        <label class="field-label">Berat Badan (kg)</label>
                        <input type="number" step="0.1" name="berat" value="{{ old('berat') }}"
                            class="field-input @error('berat') field-input--error @enderror" placeholder="Contoh: 75.5">
                        @error('berat')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field mb-3">
                        <label class="field-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                            class="field-input @error('tanggal') field-input--error @enderror">
                        @error('tanggal')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">Simpan Berat Badan</button>
                </form>
            </div>
        </div>
        <!-- INPUT BERAT BADAN -->

        <!-- RIWAYAT BB -->
        <div class="panel-card mb-4">
            <div class="panel-card__head">
                <i class="bi bi-clock-history me-2"></i> Riwayat Berat Badan
            </div>

            <div class="panel-card__body p-0">
                <div class="table-scroll">
                    <table class="table table-hover align-middle mb-0 table-padded">
                        <thead class="sticky-top">
                            <tr>
                                <th width="10%">No</th>
                                <th>Tanggal</th>
                                <th>Berat Badan</th>
                                <th>Selisih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="bi bi-calendar3 text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </td>
                                    <td>
                                        <span class="pill pill--blue">{{ $item->berat }} kg</span>
                                    </td>
                                    <td>
                                        @if (isset($riwayat[$loop->index + 1]))
                                            @php
                                                $selisih = $item->berat - $riwayat[$loop->index + 1]->berat;
                                            @endphp

                                            @if ($selisih > 0)
                                                <span class="diff diff--up">
                                                    <i class="bi bi-arrow-up"></i> +{{ number_format($selisih, 1) }} kg
                                                </span>
                                            @elseif ($selisih < 0)
                                                <span class="diff diff--down">
                                                    <i class="bi bi-arrow-down"></i> {{ number_format($selisih, 1) }} kg
                                                </span>
                                            @else
                                                <span class="diff diff--flat">
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
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-state__icon"><i class="bi bi-clipboard-data"></i></div>
                                        <p class="empty-state__title mb-1">Belum ada data berat badan</p>
                                        <small class="empty-state__desc">Catat berat badan pertamamu di form atas</small>
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
        <div class="panel-card mb-4">
            <div class="panel-card__head">
                <i class="bi bi-bar-chart-line me-2"></i> Grafik Berat Badan
            </div>
            <div class="panel-card__body">
                <canvas id="beratChart" height="100"></canvas>
            </div>
        </div>

        @include('layouts.user-chart')
        <!-- Grafik Berat Badan -->

    </div>


@endsection