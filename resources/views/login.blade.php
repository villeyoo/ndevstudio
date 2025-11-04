<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>

  <div class="login-container">
    <div class="login-card">
      <div class="logo">
        <img src="{{ asset('assets/images/viel.svg') }}" alt="Logo Ndev Studio" width="90" height="90">
      </div>

      <h2>Selamat Datang</h2>
      <p class="subtitle">Masuk Sebagai Admin.</p>

     <form action="{{ route('login.submit') }}" method="POST">
  @csrf

  <div class="input-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required placeholder="Masukkan username">
  </div>

  <div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Masukkan password">
  </div>

  <button type="submit" class="btn-login">Login Sekarang</button>
</form>

<!-- Tombol kembali -->
<a href="{{ url('/') }}" class="btn-back">← Kembali ke Beranda</a>

    </div>
  </div>

</body>
</html>
