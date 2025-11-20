<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NDEV STUDIO - NEWS</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/kasus.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>

  <button id="scrollTopBtn" title="Back to top">↑</button>

  <div class="page-container">
    <div class="hero-card">
      <nav class="navbar">
        <div class="nav-inner">
          <div class="logo"><span>Ndev Studio.</span></div>
          <div class="menu-toggle" id="menu-toggle">☰</div>

          <ul class="nav-links" id="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/#komunitas">Komunitas</a></li>
            <li><a href="/#project">Project</a></li>
            <li><a href="/news">Berita</a></li>
            <li><a class="active" href="/bukti">Bukti</a></li>
            <li><a href="/robux">Robux</a></li>
            <li><a href="{{ url('/login') }}" class="btn-nav">Login</a></li>
          </ul>
        </div>
      </nav>

      <div class="ndev-ct-hero">
        <p class="ndev-ct-rating">Halaman <strong>Bukti .</strong></p>
        <h1 class="ndev-ct-getin">
          <span class="ndev-ct-left">Dokumentasi</span>
          <span class="ndev-ct-right">Kasus.</span>
        </h1>
        <p class="ndev-ct-sub small">Seluruh bukti dan screenshot dimasukkan di sini.</p>
      </div>
    </div>
  </div>

  <section id="bukti" class="benefits-section">
    <div class="container narrow">
      <div class="benefits-header">
        <span class="badge">Bukti</span>
        <h2 class="benefits-title">Bukti Screenshot Percakapan & Penjelasan Kasus</h2>
      </div>

      {{-- LOOP DATA BUKTI --}}
      @foreach ($buktis as $bukti)
      <div class="evidence-card">

        {{-- MEDIA (Foto / Video) --}}
        <div class="evidence-image">
          @if (Str::endsWith($bukti->file_path, ['.mp4', '.mov', '.webm']))
          <video controls>
            <source src="{{ asset('storage/' . $bukti->file_path) }}">
          </video>
          @else
          <img
            src="{{ asset('storage/' . $bukti->file_path) }}"
            alt="Bukti Screenshot"
            class="clickable-image">
          @endif
        </div>

        {{-- ISI TEKS --}}
        <div class="evidence-content">
          <h3 class="evidence-title">{{ $bukti->judul }}</h3>

          <p class="evidence-date">
            {{ \Carbon\Carbon::parse($bukti->created_at)->format('d F Y') }}
          </p>

          <p class="evidence-desc">
            {{ $bukti->deskripsi }}
          </p>
        </div>

      </div>
      @endforeach

    </div>
  </section>


  <footer class="footer">
    <div class="footer-container">
      <div class="footer-col">
        <h4>NDEVSTUDIO.</h4>
        <p>From Zero To Hero.</p>
        <p class="copy">© 2025 Ndev Studio</p>
      </div>

      <div class="footer-col">
        <h4>MENU</h4>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/#project">Project</a></li>
          <li><a href="/bukti">Bukti</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>CONTACT</h4>
        <p>info@ndevstudio.com</p>
        <p>+62 851-1756-2717</p>
      </div>
    </div>
  </footer>

</body>
<div id="imgModal" class="img-modal">
  <span class="close-modal">&times;</span>
  <img class="modal-content" id="imgPreview">
</div>
<script src="{{ asset('assets/js/script.js') }}"></script>

</html>