<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request Robux - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
   <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  <!-- Sidebar -->
  @include('sidebarAdmin')

  <!-- Main Content -->
  <div class="main">
    <!-- Navbar -->
    <header class="topbar">
      <h2>Penukaran Robux Staff</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="form-container">
        <h3>Form Penukaran Robux Staff</h3> 

        @if(session('success'))
          <div style="background:#d4edda;color:#155724;padding:10px;border-radius:8px;margin-bottom:15px;">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div style="background:#f8d7da;color:#721c24;padding:10px;border-radius:8px;margin-bottom:15px;">
            <ul>
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('robux.request') }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label for="username">Username Roblox</label>
            <input type="text" id="username" name="username" placeholder="Masukkan Username Roblox Anda" required>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-back">Request Robux</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Kembali</a>
          </div>
        </form>
      </div>
    </section>
  </div>
</body>
</html>
