<div class="card mb-4 user-header-card">
    <div class="card-body py-4 px-4">
        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">
                <a href="/dashboard">
                    <img src="{{ asset('images/logoH.png') }}" alt="Logo" style="height: 40px; display: block; margin-top: -11px;">
                </a>

                <div class="vr d-none d-sm-block" style="height: 40px; opacity: 0.12;"></div>

                <nav class="d-none d-md-flex gap-1">
                    <a href="/dashboard" class="user-nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                    <a href="/chat" class="user-nav-link {{ request()->is('chat') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots me-1"></i> Layanan Konsultasi
                    </a>
                </nav>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    @php
                        $jam = now()->hour;
                        $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
                    @endphp
                    <span class="text-muted small d-block">{{ $sapaan }}</span>
                    <span class="fw-semibold">{{ session('user_name') }}</span>
                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                </div>

                <a href="/profile" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <a href="/logout" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .user-header-card {
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }

    .user-nav-link {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 15px;
        color: #6c757d;
        text-decoration: none;
        transition: background-color 0.15s ease;
    }

    .user-nav-link:hover {
        background-color: #f1f3f5;
        color: #1ca3e0;
    }

    .user-nav-link.active {
        background-color: rgba(28, 163, 224, 0.1);
        color: #1ca3e0;
        font-weight: 500;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1ca3e0, #0a4d68);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }
</style>