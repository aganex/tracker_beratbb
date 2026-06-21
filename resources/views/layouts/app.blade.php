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
        :root {
            --primary-blue: #1ca3e0;
            --dark-blue: #0a4d68;
        }

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
           AUTH (LOGIN / REGISTER)
        ========================================= */
        .auth-logo-text {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .text-dark-part {
            color: var(--dark-blue);
        }

        .text-light-part {
            color: var(--primary-blue);
        }
        /* =========================================
           AUTH (LOGIN / REGISTER)
        ========================================= */

        /* =========================================
           DASHBOARD USER
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

        .bg-orange-subtle {
            background-color: #fde8d8;
        }

        .text-orange {
            color: #c2570c;
        }

        .table-padded th,
        .table-padded td {
            padding-left: 20px;
            padding-right: 20px;
        }

        .table-padded th:first-child,
        .table-padded td:first-child {
            padding-left: 24px;
        }
        /* =========================================
           DASHBOARD USER
        ========================================= */
    </style>
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @include('layouts.design-user')

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    @stack('scripts')
</body>
</html>