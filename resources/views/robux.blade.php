<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NDEV STUDIO - ROBUX</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/robux.css') }}">
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
            <li><a href="/#collab">Collab</a></li>
            <li><a href="{{ url('/login') }}" class="btn-nav">Login</a></li>
          </ul>
        </div>
      </nav>


      <div class="hero-content">
        <p class="rating">WE MAKE COLLABORATION<b></b> NDEV x DEZONE.</p>
        <!-- HTML: ganti span existing dengan id -->
        <h1 class="hero-title">
          NDEV x DEZONEE<br>
          <span class="highlight" id="rotatingText">Sugeng Rawuh</span>Robux Di DEZONE!.
        </h1>

        <p class="subtext">
          Scroll <b>Kebawah</b> Untuk Melihat Harga Robux.
        </p>
        <div class="hero-buttons">
          <a href="#robux" class="btn-primary">Lihat Robux.</a>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->

  <!-- VALUES SECTION - mulai -->
  <section id="robux" class="pricing-section">
    <div class="values-section">
      <div class="values-inner">
        <div class="values-head">
          <span class="values-badge">HARGA ROBUX TERKINI!</span>
          <h2 class="values-title">Ini adalah Harga Robux Instant.<br>Robux bisa berubah sewaktu waktu.</h2>
        </div>

        @if($products->count() > 0)
        <div class="values-grid">
          @foreach($products as $product)
          <article class="value-card">
            <div class="value-icon" aria-hidden="true">
              <img src="{{ asset('assets/images/robux.png') }}" alt="Robux Icon">
            </div>

            <h3 class="value-title-card">{{ $product->title }}</h3>
            <p class="value-price">{{ $product->price }}</p>

            @if($product->type)
            <p class="value-type" style="color:#888; font-size:14px; margin-top:4px;">
              Jenis Pengiriman: <strong style="color:#000;">{{ ucfirst($product->type) }}</strong>
            </p>
            @endif

            <a href="{{ route('order.create', $product->id) }}" class="value-btn">Beli Sekarang</a>

          </article>
          @endforeach
        </div>
        @else
        <p style="margin-top: 20px; color: #666; font-weight: 600;">Belum ada Robux terbaru.</p>
        @endif

      </div>

    </div>


  </section>

  <!-- VALUES SECTION - akhir -->


  <footer id="collab" class="footer">
    <!-- CTA DI DALAM FOOTER -->
    <div class="footer-cta">
      <span class="cta-badge">COLLABORATION</span>
      <h2 class="cta-title">
        Punya Ide Keren?<br>
        <span>Ayo</span> Kita Obrolin!
      </h2>
      <p class="cta-text">
        Siapa tahu bisa bareng bikin sesuatu yang gede! Kami siap bantu kamu dapetin hasil terbaik.
      </p>
      <a href="mailto:ndevstudioo@gmail.com?subject=Halo%20Ndev%20Studio!&body=Hai%20Ndev%20Studio,%0ASaya%20tertarik%20untuk%20berkolaborasi%20dengan%20tim%20Anda."
        class="cta-btn">Kirimkan Email</a>

    </div>

    <!-- ISI FOOTER -->
    <div class="footer-container">
      <div class="footer-col">
        <h4>NDEVSTUDIO.</h4>
        <p>From Zero To Hero.</p>
        <p class="copy">© 2025 Ndev Studio</p>
      </div>

      <div class="footer-col">
        <h4>MENU</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#komunitas">Komunitas</a></li>
          <li><a href="#project">Project</a></li>
          <li><a href="#collab">Collab</a></li>
          <li><a href="{{ url('/login') }}">Login</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>CONTACT</h4>
        <p>info@ndevstudio.com</p>
        <p>+62 851-1756-2717</p>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="socials">
        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
      </div>
      <a href="#top" class="back-top">↑</a>
    </div>

    <div class="footer-logo">

    </div>
  </footer>



</body>
<script src="{{ asset('assets/js/robux.js') }}"></script>

</html>