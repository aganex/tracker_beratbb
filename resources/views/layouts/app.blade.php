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

        .card {

            border: none;

            border-radius: 14px;

            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);

        }

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
    </style>

</head>

<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>