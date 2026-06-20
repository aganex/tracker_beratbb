<div class="card mb-4 admin-header-card">
    <div class="card-body py-4 px-4">
        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('images/logoH.png') }}" alt="Logo" style="height: 40px; display: block; margin-top: -11px;">

                <div class="vr d-none d-sm-block" style="height: 40px; opacity: 0.12;"></div>

                <nav class="d-none d-md-flex gap-1">
                    <a href="/admin" class="admin-nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="bi bi-people me-1"></i> Manajemen Akun
                    </a>
                    <a href="/chat" class="admin-nav-link {{ request()->is('chat') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots me-1"></i> Chat Konsultasi
                        @if (isset($unreadChat) && $unreadChat > 0)
                            <span class="badge rounded-pill bg-danger ms-1">{{ $unreadChat }}</span>
                        @endif
                    </a>
                </nav>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success-subtle text-success fw-normal px-2 py-1">
                    <i class="bi bi-shield-check me-1"></i> Admin
                </span>

                <div class="admin-avatar">
                    {{ strtoupper(substr(session('user_name', 'A'), 0, 1)) }}
                </div>

                <a href="/logout" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .admin-header-card {
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }

    .admin-nav-link {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 15px;
        color: #6c757d;
        text-decoration: none;
        transition: background-color 0.15s ease;
    }

    .admin-nav-link:hover {
        background-color: #f1f3f5;
        color: #1ca3e0;
    }

    .admin-nav-link.active {
        background-color: rgba(28, 163, 224, 0.1);
        color: #1ca3e0;
        font-weight: 500;
    }

    .admin-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #eaf0fb;
        color: #1ca3e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

</style>