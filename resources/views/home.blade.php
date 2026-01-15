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
        <!-- HTML: ganti span existing dengan id -->
        <h1 class="hero-title">
          Helooo<br>
          <span class="highlight" id="rotatingText">Sugeng Rawuh</span> Di Ndev Studio!.
        </h1>

        <p class="subtext">
          Menciptakan <b>game kecil</b> dengan suasana santai dan cerita yang dekat.
        </p>
        <div class="hero-buttons">
          <a href="/laporan" class="btn-secondary">LAPORKAN.</a>
          <a href="{{ url('/hire') }}" class="btn-secondary">Request/Daftar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- <section id="gameDesa" class="features-section">
    <div class="container">
      <div class="features-left">
        <span class="badge">DESA INDO</span>
        <h2 class="feature-title">MAINKAN DESA INDO.<br><span>DI <em>ROBLOX</em>.</span></h2>
        <div class="rating-line">
          <div class="stars"></div>
          <div class="rating-text">1M+ <strong></strong> VISIT.</div>
        </div>

        <div class="feature-buttons">
          <button class="feature-item active">
            <a href="https://www.roblox.com/games/98998191230286/DESA-INDO" class="feature-item active" target="_blank" rel="noopener">
              DESA INDO [13+] <span class="arrow">→</span>
            </a>
          </button>
          <button class="feature-item active">
            <a href="https://www.roblox.com/games/137551897183416/DESA-INDO-13" class="feature-item active" target="_blank" rel="noopener">
              DESA INDO [18+] <span class="arrow">→</span>
            </a>

          </button>
        </div>
      </div>

      <div class="features-right">
        <div class="image-card">
          <img src="{{ asset('assets/images/desaindo.png') }}" alt="Revenue preview" class="feature-image">
        </div>
      </div>
    </div>
  </section> -->

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
            <a href="https://discord.gg/desaindo" class="feature-item active" target="_blank" rel="noopener">
              SERVER &amp; DISCORD BARU <span class="arrow">→</span>
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
  <section id="team" class="team-section">
    <div class="container narrow">
      <div class="team-header">
        <span class="badge">Team</span>
        <h2 class="team-title">Tim Kami.</h2>
      </div>

      <div class="team-grid">
        <!-- Anggota 1 -->
        <div class="team-card">
          <img src="{{ asset('assets/images/nabil.jpg') }}" alt="Team member 1" class="team-photo">
          <div class="team-info">
            <h3 class="team-name">NABIL MAULANA AL HAKIM</h3>
            <p class="team-role">Founder & IT Lead Developer</p>
            <a href="#" class="team-social"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>

        <!-- Anggota 2 -->
        <div class="team-card">
          <img src="{{ asset('assets/images/noprofil.png') }}" alt="Team member 2" class="team-photo">
          <div class="team-info">
            <h3 class="team-name">NNHDYNI</h3>
            <p class="team-role">Partner.</p>
            <a href="#" class="team-social"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>

        <!-- Anggota 3 -->
        <div class="team-card">
          <img src="{{ asset('assets/images/noprofil.png') }}" alt="Team member 3" class="team-photo">
          <div class="team-info">
            <h3 class="team-name">DEVA ADITYA</h3>
            <p class="team-role">Co Founder & IT</p>
            <a href="#" class="team-social"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="desaindo" class="benefits-section">
    
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