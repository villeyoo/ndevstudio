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
          <a href="#cekPajak" class="btn-secondary">Cek Pajak Gamepass.</a>
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
          <h2 class="values-title"><br></h2>
        </div>

        @php
        $shop = ['open' => true];
        $shopPath = storage_path('app/shop_status.json');
        if (file_exists($shopPath)) {
        $shop = json_decode(file_get_contents($shopPath), true) ?? $shop;
        }
        @endphp

        {{-- 💥 Jika toko tutup --}}
        @if(empty($shop['open']))
        <p style="margin-top:20px; color:#ff4444; font-weight:700; font-size:18px;">
          🚧 Toko Sedang Tutup — Silakan kembali nanti.
        </p>

        {{-- 💥 Jika toko buka dan ada produk --}}
        @elseif($products->count() > 0)

        <div class="values-grid">
          @foreach($products as $product)
          <article class="value-card">
            <div class="value-icon">
              <img src="{{ asset('assets/images/robux.png') }}" alt="Robux Icon">
            </div>

            <h3 class="value-title-card">{{ $product->title }}</h3>
            <p class="value-price">{{ $product->price }}</p>

            @if($product->type)
            <span class="value-type-badge">{{ ucfirst($product->type) }}</span>
            @endif

            <a href="{{ route('order.create', $product->id) }}" class="value-btn">Beli Sekarang</a>
          </article>
          @endforeach
        </div>

        {{-- 💥 Toko buka tapi produk kosong --}}
        @else
        <p style="margin-top: 20px; color: #666; font-weight: 600;">
          Belum ada Robux terbaru.
        </p>
        @endif

      </div>
    </div>
  </section>

  <section id="cekPajak">
    <!-- ======= Section: Cek Pajak Gamepass (Reverse Calculator) ======= -->
    <section class="cek-pajak-wrapper">
      <div class="cek-pajak-card" id="cek-pajak">
        <h3 class="cek-pajak-title">Cek Pajak Gamepass — Hitung Harga Gamepass</h3>
        <p class="cek-pajak-desc">Masukkan berapa Robux yang ingin diterima oleh mu (bersih). Kalkulator akan memberi tahu harga gamepass yang harus ditetapkan supaya setelah potongan 30% kamu menerima jumlah tersebut.</p>

        <div class="cek-pajak-row">
          <label class="cek-pajak-label" for="gp-net">Target yang ingin diterima (Robux)</label>
          <input class="cek-pajak-input" id="gp-net" type="number" min="0" step="1" placeholder="Contoh: 1000" />
        </div>

        <div class="cek-pajak-actions">
          <button id="gp-calc" class="btn-cek" type="button">Hitung</button>
          <button id="gp-reset" class="btn-cek btn-reset" type="button">Reset</button>
        </div>

        <div id="gp-result" class="cek-pajak-result" aria-live="polite" style="opacity:0; transform:translateY(8px); pointer-events:none;">
          <!-- Hasil di-inject lewat JS -->
          <div class="result-inner">
            <div class="result-values">
              <div class="rv-row"><span>Buat Gamepass Seharga (wajib):</span><strong id="res-gross">—</strong></div>
              <div class="rv-row"><span>Potongan Roblox (30%):</span><strong id="res-tax">—</strong></div>
              <div class="rv-row"><span>Diterima (bersih):</span><strong id="res-net">—</strong></div>
            </div>
            <div class="result-actions">
              <button id="res-copy" class="btn-small">Salin Harga</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======= End Cek Pajak ======= -->

    <!-- ======= End Cek Pajak Gamepass ======= -->

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