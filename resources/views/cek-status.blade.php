<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cek Status - NDEV Studio</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/cekstatus.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>

  <!-- NAVBAR (capsule centered - same style as homepage) -->


<!-- HERO SECTION -->
<section class="hero">
  <div class="hero-card">
    <div class="hero-content">
      <h1>Cek Status Pendaftaran</h1>
      <p>Masukkan username Discord yang kamu pakai ketika mendaftar untuk melihat status.</p>

      <!-- Form langsung di sini -->
      <form action="{{ route('cek-status.check') }}" method="POST" class="status-form-inline">
        @csrf
        <input class="input" type="text" name="discord" id="discord" placeholder="Masukkan username Discord (mis. user#1234)" required>
        <button type="submit" class="btn-primary">Cek Status</button>
      </form>

      <div class="btn-wrapper">
        <a href="{{ url('/') }}" class="btn small">Kembali ke Beranda</a>
      </div>

      <!-- Pesan status -->
      @if(session('error'))
        <div class="status-msg error">{{ session('error') }}</div>
      @endif

      @isset($status)
        <div class="status-msg result {{ $status }}">
          @if($status == 'diterima')
            <strong>Diterima</strong> — Selamat! Anda diterima sebagai <strong>{{ $role }}</strong>.
          @elseif($status == 'ditolak')
            <strong>Ditolak</strong> — Mohon maaf, pendaftaran Anda ditolak (role: {{ $role }}).
          @else
            <strong>Pending</strong> — Pendaftaran Anda masih dalam proses. Silakan tunggu.
          @endif
        </div>
      @endisset
    </div>
  </div>
</section>

  <!-- PENGUMUMAN (opsional, muncul bila ada hasil) -->
  @isset($status)
  <section class="announcement">
    <div class="announcement-card {{ $status }}">
      <h4>Pengumuman untuk <span>{{ $discord }}</span></h4>

      @if($status == 'diterima')
        <p>Selamat! Permintaanmu telah <strong>DITERIMA</strong>. Role: <strong>{{ $role }}</strong>.</p>
      @elseif($status == 'ditolak')
        <p>Mohon maaf, permintaanmu <strong>DITOLAK</strong>. Silakan periksa kembali persyaratan.</p>
      @else
        <p>Status pendaftaranmu saat ini <strong>PENDING</strong>. Mohon ditunggu proses verifikasi.</p>
      @endif
    </div>
  </section>
  @endisset

  <!-- Script: toggle menu & sticky shadow -->
  <script>
    (function(){
      const menuToggle = document.getElementById('menu-toggle');
      const navLinks = document.getElementById('nav-links');
      const navbar = document.querySelector('.navbar');

      if(menuToggle){
        menuToggle.addEventListener('click', () => {
          navLinks.classList.toggle('show');
        });
      }

      window.addEventListener('scroll', () => {
        if(window.scrollY > 40){
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });
    })();
  </script>
</body>
</html>
