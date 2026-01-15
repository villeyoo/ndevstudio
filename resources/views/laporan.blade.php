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
                        <li><a href="/">Home</a></li>
                        <li><a href="#komunitas">Komunitas</a></li>
                        <li><a href="#project">Project</a></li>
                        <li><a href="#collab">Collab</a></li>
                        <li><a href="{{ url('/login') }}" class="btn-nav">Login</a></li>
                    </ul>
                </div>
            </nav>

            <div class="ndev-ct-hero">

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('token'))
                <div class="alert alert-info">
                    <strong>Token Laporan Anda:</strong><br>
                    <code>{{ session('token') }}</code>
                    <p>Simpan token ini untuk mengecek status laporan.</p>
                </div>
                @endif

                <p class="ndev-ct-rating">FORM <strong>LAPORAN</strong></p>

                <h1 class="ndev-ct-getin">
                    <span class="ndev-ct-left">LAPORAN</span>
                    <span class="ndev-ct-right">NDEV STUDIO.</span>
                </h1>

                <p class="ndev-ct-sub small">
                    Sampaikan laporan, kritik, atau ide fitur secara anonim atau terbuka.
                </p>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="hero-tombol">
                    <a href="{{ route('laporan.cek.form') }}" class="btn-third">
                        cek laporanku.
                    </a>

                </div>
                <div class="ndev-ct-card">
                    <form method="POST" action="{{ route('laporan.kirim') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama (opsional / anonim) -->
                        <div class="ndev-ct-row">
                            <label class="ndev-ct-label">Nama (Opsional)</label>
                            <input class="gayane" type="text" name="nama" placeholder="Kosongkan jika ingin anonim">
                        </div>

                        <!-- Kontak (opsional) -->
                        <div class="ndev-ct-row">
                            <label class="ndev-ct-label">Kontak (Opsional Tidak Wajib Di Isi)</label>
                            <input class="gayane" type="text" name="kontak" placeholder="Discord / WhatsApp / Email">
                        </div>

                        <!-- Kategori -->
                        <div class="ndev-ct-row">
                            <label class="ndev-ct-label">Kategori Laporan</label>
                            <select class="gayane" name="kategori" required>
                                <option value="">Pilih kategori</option>
                                <option value="Report Admin">Laporkan Admin</option>
                                <option value="Report Player">Laporkan Player</option>
                                <option value="kritik dan saran">Kritik & Saran</option>
                                <option value="request fitur">Request Fitur</option>
                                <option value="bug">Bug / Error</option>
                            </select>
                        </div>

                        <!-- Isi laporan -->
                        <div class="ndev-ct-row">
                            <label class="ndev-ct-label">Isi Laporan</label>
                            <textarea class="gayane" name="isi" rows="6" placeholder="Jelaskan laporan kamu secara detail..." required></textarea>
                        </div>
                        <!-- Attachment (Opsional) -->
                        <div class="ndev-ct-row">
                            <label class="ndev-ct-label">
                                Lampiran (Opsional)
                            </label>

                            <input
                                class="gayane"
                                type="file"
                                name="attachment"
                                accept="image/*,video/*,.pdf,.zip,.rar">

                            <small class="ndev-ct-hint">
                                Bisa upload foto, video, atau file pendukung (maks 10MB).
                            </small>
                        </div>


                        <button type="submit" class="ndev-ct-submit">
                            KIRIM LAPORAN
                        </button>



                        <p class="ndev-ct-note">
                            Data laporan akan dijaga kerahasiaannya.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- section -->



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