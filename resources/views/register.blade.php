<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    @if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <button type="submit">Register</button>
</form>
