<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran - NDEV Studio</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/hire.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!-- SweetAlert -->
@if(session('swal'))
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        };
    </script>
@endif

<!-- NAVBAR -->


<!-- HERO SECTION -->
<section class="hero">
  <div class="hero-content">
    <h1>Ndev Studio<br>Membuka pengalaman baru untukmu!</h1>
    <p>Pilih posisi sesuai minatmu dan bergabung bersama kami.</p>
    <div class="btn-wrapper">
      <a href="{{ url('/cek-status') }}" class="btn">Cek Request atau Status Pendaftaran</a>
    </div>
  </div>
  <div class="hero-image">
    <img src="{{ asset('assets/images/viel.svg') }}" alt="maskot" class="maskot">
  </div>
</section>

<!-- LOWONGAN SECTION -->
<div class="container">
  <h2 class="judul">Posisi Tersedia</h2>

  @forelse ($lowongans as $lowongan)
  <div class="card-lowongan">
    <div class="card-info">
      <h3>{{ $lowongan->judul }}</h3>
      <small>
        Periode {{ \Carbon\Carbon::parse($lowongan->mulai)->format('d M Y') }}
        – {{ \Carbon\Carbon::parse($lowongan->selesai)->format('d M Y') }}
      </small>
      <p>{{ $lowongan->deskripsi }}</p>
    </div>
    <div class="card-action">
      <a href="{{ route('daftar.form') }}" class="btn-daftar">Daftar</a>
    </div>
  </div>
  @empty
  <div class="card-lowongan">
    <div class="card-info">
      <h3>Tidak ada pembukaan</h3>
      <p>Saat ini belum ada posisi yang tersedia.</p>
    </div>
  </div>
  @endforelse
</div>

<!-- JAVASCRIPT -->
<script>
  // Toggle menu untuk mobile
  const menuToggle = document.getElementById("menu-toggle");
  const navLinks = document.getElementById("nav-links");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("show");
  });

  // Shadow effect saat scroll
  window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Smooth scroll untuk link internal
  document.querySelectorAll('.nav-links a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
      navLinks.classList.remove('show');
    });
  });
</script>

</body>
</html>
