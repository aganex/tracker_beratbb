<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>

<div style="width: 500px; margin: 30px auto;">

    <h1>Edit Profile</h1>

    <a href="/dashboard">
        Kembali ke Dashboard
    </a>

    <br><br>

    {{-- NOTIF SUCCESS --}}
    @if (session('success'))

        <p style="color:green;">
            {{ session('success') }}
        </p>

    @endif

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())

        <div style="color:red;">

            @foreach ($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif

    <form method="POST" action="/profile">

        @csrf

        {{-- NAMA --}}
        <label>Nama</label><br>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        {{-- TINGGI BADAN --}}
        <label>Tinggi Badan (cm)</label><br>

        <input
            type="number"
            name="tinggi_badan"
            value="{{ old('tinggi_badan', $user->tinggi_badan) }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        {{-- JENIS KELAMIN --}}
        <label>Jenis Kelamin</label><br>

        <select
            name="jenis_kelamin"
            style="width:100%; padding:8px;"
        >

            <option value="">
                -- Pilih Jenis Kelamin --
            </option>

            <option
                value="Laki-laki"
                {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}
            >
                Laki-laki
            </option>

            <option
                value="Perempuan"
                {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}
            >
                Perempuan
            </option>

        </select>

        <br><br>

        {{-- TANGGAL LAHIR --}}
        <label>Tanggal Lahir</label><br>

        <input
            type="date"
            name="tanggal_lahir"
            value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        {{-- TARGET BERAT --}}
        <label>Target Berat Badan (kg)</label><br>

        <input
            type="number"
            step="0.1"
            name="target_berat"
            value="{{ old('target_berat', $user->target_berat) }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        {{-- AKTIVITAS --}}
        <label>Aktivitas Harian</label><br>

        <select
            name="aktivitas"
            style="width:100%; padding:8px;"
        >

            <option value="">
                -- Pilih Aktivitas --
            </option>

            <option
                value="Tidak Aktif"
                {{ $user->aktivitas == 'Tidak Aktif' ? 'selected' : '' }}
            >
                Tidak Aktif
            </option>

            <option
                value="Ringan"
                {{ $user->aktivitas == 'Ringan' ? 'selected' : '' }}
            >
                Ringan
            </option>

            <option
                value="Sedang"
                {{ $user->aktivitas == 'Sedang' ? 'selected' : '' }}
            >
                Sedang
            </option>

            <option
                value="Aktif"
                {{ $user->aktivitas == 'Aktif' ? 'selected' : '' }}
            >
                Aktif
            </option>

            <option
                value="Sangat Aktif"
                {{ $user->aktivitas == 'Sangat Aktif' ? 'selected' : '' }}
            >
                Sangat Aktif
            </option>

        </select>

        <br><br>

        <button type="submit">
            Simpan Profile
        </button>

    </form>

</div>

</body>
</html>