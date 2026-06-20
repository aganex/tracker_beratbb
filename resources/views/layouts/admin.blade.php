<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =========================================
           GLOBAL
        ========================================= */
        body {
            background-color: #f5f6fa;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }
        /* =========================================
           GLOBAL
        ========================================= */

        /* =========================================
           DASHBOARD ADMIN
        ========================================= */
        .stat-card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .bg-pink-subtle {
            background-color: #fbeaf0;
            color: #d4537e;
        }

        .user-avatar-sm {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #eaf0fb;
            color: #1ca3e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
            flex-shrink: 0;
        }

        .search-input {
            padding-left: 38px;
        }

        .table thead.sticky-top th {
            background: #f8f9fa;
            z-index: 10;
        }
        /* =========================================
           DASHBOARD ADMIN
        ========================================= */

        /* =========================================
           SCROLL TABLE
        ========================================= */
        .table-scroll {
            max-height: 500px;
            overflow-y: auto;
        }
        /* =========================================
           SCROLL TABLE
        ========================================= */

        /* =========================================
           BUTTON
        ========================================= */
        .btn-info {
            color: white;
        }
        /* =========================================
           BUTTON
        ========================================= */
    </style>
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>