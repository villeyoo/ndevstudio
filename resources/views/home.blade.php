<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NDEV STUDIO</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                <li><a href="#">Home</a></li>
                <li><a href="#komunitas">Komunitas</a></li>
                <li><a href="#project">Project</a></li>
                  <li><a href="#collab">Collab</a></li>
                <li><a href="{{ url('/login') }}" class="btn-nav">Login</a></li>
            </ul>
        </div>
        </nav>


            <div class="hero-content">
                <p class="rating">From Code<b>To</b> Adventure.</p>
                <h1 class="hero-title">
                    Helooo<br>
                    <span class="highlight">Sugeng Rawuh</span> Di Ndev Studio!.
                </h1>
                <p class="subtext">
                 Menciptakan <b>game kecil</b> dengan suasana santai dan cerita yang dekat.
                </p>
                <div class="hero-buttons">
                    <a href="#desaindo" class="btn-primary">Event Desa Indo.</a>
                    <a href="{{ url('/hire') }}" class="btn-secondary">Request/Daftar</a>
                </div>
            </div>
        </div>
    </div>

<section id="komunitas" class="features-section">
  <div class="container">
    <div class="features-left">
      <span class="badge">JOIN KOMUNITAS</span>
      <h2 class="feature-title">AYO NGOBROL BARENG.<br><span>DI <em>DISCORD</em>.</span></h2>
      <div class="rating-line">
        <div class="stars"></div>
        <div class="rating-text">2588 <strong></strong> MEMBERS.</div>
      </div>

    <div class="feature-buttons">
  <button class="feature-item active">
    <a href="https://discord.gg/your-server-invite" class="feature-item active" target="_blank" rel="noopener">
  SERVER &amp; DISCORD BARU [COOMING SOON] <span class="arrow">→</span>
</a>

  </button>
</div>

    </div>

    <div class="features-right">
      <div class="image-card">
        <!-- Ganti src sesuai lokasi gambarmu, contoh: /assets/images/revenue.png -->
        <img src="{{ asset('assets/images/desa.png') }}" alt="Revenue preview" class="feature-image">
      </div>
    </div>
  </div>
</section>

<section id="project" class="cases-section">
  <div class="container narrow">
    <div class="cases-header">
      <span class="badge">PROJECT</span>
      <h2 class="cases-title">Project Kami<br>Lihat Disini.</h2>
    </div>

    <div class="cases-grid">
      <div class="case-card">
        <div class="case-image-wrap">
          <img src="{{ asset('assets/images/ndev.png') }}" alt="Case study 1 preview" class="case-image">
        </div>
        <h3 class="case-headline">DESA INDO.</h3>
        <p class="case-desc">Nikmati pengalaman hidup di desa:
Bangun pertemanan baru, lakukan aktivitas sehari-hari, dan jelajahi lingkungan yang terinspirasi dari budaya Nusantara. Setiap sudut desa menyimpan cerita — dan kamu yang menentukan arah ceritanya!
.</p>
      </div>

      <div class="case-card">
        <div class="case-image-wrap">
          <img src="{{ asset('assets/images/ndevv.png') }}" alt="Case study 2 preview" class="case-image">
        </div>
        <h3 class="case-headline">Cooming Soon</h3>
        <p class="case-desc"></p>
      </div>
    </div>
  </div>
</section>

<section id="desaindo" class="benefits-section">
  <div class="container narrow">
    <div class="benefits-header">
      <span class="badge">EVENT DESA INDO</span>
      <h2 class="benefits-title">Syarat<br>Dan Ketentuan.</h2>
    </div>

   <div class="benefits-list">
  <div class="benefit-item">
    <div class="benefit-number">01</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Tema</h3>
      <p>
        Konten harus bertemakan kepahlawanan yang dikaitkan dengan game <strong>DESA INDO</strong>. 
        Tema bisa tentang perjuangan, semangat gotong royong, kebersamaan, atau keberanian versi kalian sendiri. 
        Boleh lucu, serius, atau inspiratif — yang penting tetap relevan dengan suasana Hari Pahlawan.
      </p>
    </div>
  </div>

  <div class="benefit-item">
    <div class="benefit-number">02</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Periode Event</h3>
      <p>
        Event dimulai pada <strong>7 November 2025</strong>, bersamaan dengan update terbaru di game <strong>DESA INDO</strong>.  
        Pengumpulan konten berlangsung hingga <strong>27 November 2025 pukul 23:59 WIB</strong>.  
        Pengumuman pemenang akan dilakukan beberapa hari setelah periode event berakhir.
      </p>
    </div>
  </div>

  <div class="benefit-item">
    <div class="benefit-number">03</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Cara Ikut</h3>
      <p>
        Buat video TikTok sekreatif mungkin sesuai tema, <strong> WAJIB DI DESA INDO</strong> lalu upload ke akun TikTok kamu.  
        Gunakan tagar: <strong>#DesaIndo #DesaUntukIndonesia #EventDesa</strong>.  
        Pastikan akun TikTok kamu tidak dikunci (private) agar kami bisa menilai videonya.
      </p>
    </div>
  </div>

  <div class="benefit-item">
    <div class="benefit-number">04</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Kriteria Penilaian</h3>
      <p>
        Penilaian akan didasarkan pada:
        <ul>
          <li>Kreativitas ide dan penyampaian pesan.</li>
          <li>Kesesuaian dengan tema Hari Pahlawan & game DESA INDO.</li>
          <li>Interaksi di TikTok (likes, views, dan komentar).</li>
          <li>Orisinalitas konten (tidak menjiplak atau re-upload karya orang lain).</li>
        </ul>
      </p>
    </div>
  </div>

  <div class="benefit-item">
    <div class="benefit-number">05</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Hadiah</h3>
      <p>
        Total hadiah sebesar <strong>Rp 2.000.000</strong> akan dibagikan kepada para pemenang dengan rincian sebagai berikut:
        <ul>
          <li><strong>Juara 1:</strong> Rp 1.000.000</li>
          <li><strong>Juara 2:</strong> Rp 250.000 + 3.000 Robux</li>
          <li><strong>Juara 3:</strong> Rp 150.000 2.000 Robux</li>
          <li><strong>Juara Views Terbanyak:</strong> 1.000 Robux</li>
        </ul>
      </p>
    </div>
  </div>

  <div class="benefit-item">
    <div class="benefit-number">06</div>
    <div class="benefit-content">
      <h3 class="benefit-heading">Ketentuan Tambahan</h3>
      <p>
        <ul>
          <li>Konten yang mengandung unsur SARA, kekerasan, atau pelanggaran aturan TikTok akan didiskualifikasi.</li>
          <li>Panitia berhak menggunakan kembali konten peserta untuk keperluan promosi Ndev Studio dengan mencantumkan kredit pembuat.</li>
          <li>Setiap peserta hanya boleh mengirim 1 video.</li>
          <li>Keputusan panitia bersifat final dan tidak dapat diganggu gugat.</li>
        </ul>
      </p>
    </div>
  </div>
</div>



    <div class="benefits-button">
      <a href="{{ route('about') }}" class="btn-primary">Join Event</a>
    </div>
  </div>
</section>



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
<script src="{{ asset('assets/js/script.js') }}"></script>
</html>
