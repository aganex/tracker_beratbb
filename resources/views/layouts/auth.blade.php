<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1ca3e0;
            --dark-blue: #0a4d68;
        }

        body {
            background-color: #f5f6fa;
        }

        .auth-logo-text {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .auth-logo-text .text-dark-part {
            color: var(--dark-blue);
        }

        .auth-logo-text .text-light-part {
            color: var(--primary-blue);
        }

        .auth-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .auth-card .card-body {
            padding: 2.5rem;
        }

        .auth-title {
            color: var(--primary-blue);
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
        }

        .form-control {
            background-color: #eaf0fb;
            border: 1px solid #eaf0fb;
            padding: 0.7rem 1rem;
            border-radius: 8px;
        }

        .form-control:focus {
            background-color: #eaf0fb;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(28, 163, 224, 0.15);
        }

        .btn-auth {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            padding: 0.7rem;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-auth:hover {
            background-color: #168bc2;
            border-color: #168bc2;
        }

        .auth-link {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .auth-footer {
            color: #8a94a6;
            font-size: 0.85rem;
        }

        .auth-footer a {
            color: #8a94a6;
            text-decoration: none;
        }

        .auth-footer a:hover {
            color: var(--primary-blue);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center py-5">
            <div class="col-md-5">

                {{-- LOGO --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo1.png') }}" alt="Tracker BB" height="300" class="mb-2">
                </div>

                <div class="card auth-card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>

                <div class="text-center mt-4 auth-footer">
                    <a href="#">Ketentuan Penggunaan</a>
                    <span class="mx-1">|</span>
                    <a href="#">Kebijakan Privasi</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>