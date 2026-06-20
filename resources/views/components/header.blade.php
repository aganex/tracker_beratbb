<div class="d-flex justify-content-between align-items-center mb-4">

    <div class="d-flex align-items-center">

        <img
            src="{{ asset('images/logoH.png') }}"
            alt="Tracker BB"
            height="50"
            class="me-3"
        >

        <div>

            <h2 class="mb-1">
                Tracker BB
            </h2>

            <p class="text-muted mb-0">
                Halo, {{ session('user_name') }}
            </p>

        </div>

    </div>

    <div>

        <a href="/profile" class="btn btn-primary">
            Edit Profile
        </a>

        <a href="/logout" class="btn btn-outline-danger">
            Logout
        </a>

    </div>

</div>