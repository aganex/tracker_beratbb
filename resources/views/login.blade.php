<h2>Login</h2>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
    @csrf

    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>

<br>

<p>Belum punya akun?</p>
<a href="/register">Register di sini</a>