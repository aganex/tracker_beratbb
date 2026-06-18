<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tracker BB</title>
</head>

<body>

<div style="width: 700px; margin: 30px auto;">

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}

    <h1>Dashboard Tracker BB</h1>

    <p>
        Halo,
        {{ session('user_name') }}
    </p>

    <a href="/dashboard">
        Dashboard
    </a>

    |

    <a href="/profile">
        Edit Profile
    </a>

    |

    <a href="/logout">
        Logout
    </a>

    <hr><br>

    {{-- ================================================= --}}
    {{-- NOTIFIKASI --}}
    {{-- ================================================= --}}

    @if (session('success'))

        <p style="color:green;">

            {{ session('success') }}

        </p>

    @endif

    {{-- ================================================= --}}
    {{-- ERROR VALIDASI --}}
    {{-- ================================================= --}}

    @if ($errors->any())

        <div style="color:red;">

            @foreach ($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif

    {{-- ================================================= --}}
    {{-- INFORMASI TUBUH --}}
    {{-- ================================================= --}}

    <h2>Informasi Tubuh</h2>

    <table border="1" cellpadding="10" width="100%">

        <tr>

            <td width="50%">
                Tinggi Badan
            </td>

            <td>
                {{ $user->tinggi_badan ?? '-' }} cm
            </td>

        </tr>

        <tr>

            <td>
                Jenis Kelamin
            </td>

            <td>
                {{ $user->jenis_kelamin ?? '-' }}
            </td>

        </tr>

        <tr>

            <td>
                Umur
            </td>

            <td>
                {{ $umur ?? '-' }} tahun
            </td>

        </tr>

        <tr>

            <td>
                Berat Terbaru
            </td>

            <td>
                {{ $beratTerbaru->berat ?? '-' }} kg
            </td>

        </tr>

        <tr>

            <td>
                BMI
            </td>

            <td>
                {{ $bmi ?? '-' }}
            </td>

        </tr>

        <tr>

            <td>
                Status BMI
            </td>

            <td>
                {{ $statusBMI ?? '-' }}
            </td>

        </tr>

    </table>

    <br><hr><br>

    {{-- ================================================= --}}
    {{-- TARGET & KALORI --}}
    {{-- ================================================= --}}

    <h2>Target & Kalori</h2>

    <table border="1" cellpadding="10" width="100%">

        <tr>

            <td width="50%">
                BMR
            </td>

            <td>
                {{ $bmr ?? '-' }} kcal
            </td>

        </tr>

        <tr>

            <td>
                Kalori Harian
            </td>

            <td>
                {{ $kaloriHarian ?? '-' }} kcal
            </td>

        </tr>

        <tr>

            <td>
                Target Berat
            </td>

            <td>
                {{ $user->target_berat ?? '-' }} kg
            </td>

        </tr>

        <tr>

            <td>
                Sisa Target
            </td>

            <td>
                {{ $sisaTarget ?? '-' }} kg
            </td>

        </tr>

    </table>

    <br><hr><br>

    {{-- ================================================= --}}
    {{-- INPUT BERAT BADAN --}}
    {{-- ================================================= --}}

    <h2>Input Berat Badan</h2>

    <form method="POST" action="/berat-badan">

        @csrf

        <label>
            Berat Badan (kg)
        </label>

        <br>

        <input
            type="number"
            step="0.1"
            name="berat"
            value="{{ old('berat') }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        <label>
            Tanggal
        </label>

        <br>

        <input
            type="date"
            name="tanggal"
            value="{{ old('tanggal') }}"
            max="{{ date('Y-m-d') }}"
            style="width:100%; padding:8px;"
        >

        <br><br>

        <button type="submit">
            Simpan Berat Badan
        </button>

    </form>

    <br><hr><br>

    {{-- ================================================= --}}
    {{-- RIWAYAT BERAT BADAN --}}
    {{-- ================================================= --}}

    <h2>Riwayat Berat Badan</h2>

    <table border="1" cellpadding="10" width="100%">

        <tr>

            <th>No</th>

            <th>Tanggal</th>

            <th>Berat</th>

        </tr>

        @forelse ($riwayat as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->tanggal }}
                </td>

                <td>
                    {{ $item->berat }} kg
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3">

                    Belum ada data berat badan

                </td>

            </tr>

        @endforelse

    </table>

</div>

</body>
</html>