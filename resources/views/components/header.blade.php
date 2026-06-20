<div class="d-flex justify-content-between align-items-center mb-4 header-card">
    <div class="d-flex align-items-center">
        <img
            src="{{ asset('images/logoH.png') }}"
            alt="Tracker BB"
            height="44"
            class="me-3"
        >

        <div class="vr me-3 d-none d-sm-block" style="height: 36px; opacity: 0.15;"></div>

        <div class="d-flex align-items-center">
            <div class="user-avatar me-3">
                {{ strtoupper(substr(session('user_name'), 0, 1)) }}
            </div>

            <div>
                @php
                    $jam = now()->hour;
                    $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
                @endphp

                <p class="text-muted mb-0 small">{{ $sapaan }},</p>
                <h5 class="mb-0 fw-semibold">{{ session('user_name') }}</h5>
            </div>
        </div>
    </div>

    <div>
        <a href="/profile" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil-square me-1"></i> Edit Profile
        </a>
        <a href="/logout" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
    </div>
</div>

<style>
    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1ca3e0, #0a4d68);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
</style>