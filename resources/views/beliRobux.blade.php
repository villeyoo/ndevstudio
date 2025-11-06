<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NDEV STUDIO - BELI ROBUX</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/beliobux.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
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
        <p class="rating">Form<b></b> Pembelian.</p>
        <h1 class="hero-title">Isi Data<br>Untuk <span class="highlight">Membeli Robux</span>.</h1>
        <p class="subtext">Pastikan data kamu benar agar Robux dikirim dengan cepat.</p>
        <div class="ndevbuy-card">
          <h2 class="ndevbuy-title">Form Pembelian Robux</h2>
          <p class="ndevbuy-subtitle">Isi data dengan benar agar Robux cepat dikirim.</p>

          <div class="ndevbuy-product">
            <p><strong>Produk:</strong> {{ $product->title }}</p>
            @php
            $cleanPrice = preg_replace('/[^0-9]/', '', $product->price);
            @endphp
            <p><strong>Harga:</strong> Rp {{ number_format((int)$cleanPrice, 0, ',', '.') }}</p>
            @if($product->type)
            <p><strong>Jenis Pengiriman:</strong> {{ ucfirst($product->type) }}</p>
            @endif
          </div>

          <form action="{{ route('order.store') }}" method="POST" class="ndevbuy-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="ndevbuy-row">
              <label for="username" class="ndevbuy-label">Username Roblox</label>
              <input type="text" id="username" name="username" placeholder="Masukkan username Roblox" required>
            </div>

            <div class="ndevbuy-row">
              <label for="whatsapp" class="ndevbuy-label">No WhatsApp</label>
              <input type="text" id="whatsapp" name="whatsapp" placeholder="Contoh: 628xxxxxxx" required>
            </div>

            <div class="ndevbuy-row">
              <label for="payment_method" class="ndevbuy-label">Metode Pembayaran</label>
              <select id="payment_method" name="payment_method" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="Blu">Blu Bca Digital</option>
                <option value="Qris">QRIS</option>
              </select>
            </div>

            <button type="submit" class="ndevbuy-submit">Kirim Pesanan</button>
            <a href="{{ url('/robux/#robux') }}" class="ndevbuy-back">Kembali</a>
            <p class="ndevbuy-note">Pastikan semua data sudah benar sebelum mengirim.</p>
          </form>
        </div>
      </div>
    </div>
  </div>


  <footer id="collab" class="footer">
    <div class="footer-cta">
      <span class="cta-badge">COLLABORATION</span>
      <h2 class="cta-title">Punya Ide Keren?<br><span>Ayo</span> Kita Obrolin!</h2>
      <p class="cta-text">Siapa tahu bisa bareng bikin sesuatu yang gede! Kami siap bantu kamu dapetin hasil terbaik.</p>
      <a href="mailto:ndevstudioo@gmail.com?subject=Halo%20Ndev%20Studio!&body=Hai%20Ndev%20Studio,%0ASaya%20tertarik%20untuk%20berkolaborasi."
        class="cta-btn">Kirimkan Email</a>
    </div>

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
  </footer>

  <script src="{{ asset('assets/js/robux.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const waInput = document.getElementById("whatsapp");

      waInput.addEventListener("input", function() {
        let value = waInput.value.trim();

        // Kalau input dimulai dengan 0 → ubah jadi 62
        if (value.startsWith("0")) {
          waInput.value = "wa.me/62" + value.substring(1);
        }

        // Hilangkan karakter selain angka
   
      });

      // Optional: Kalau user klik input dan masih kosong → auto isi "62"
      waInput.addEventListener("focus", function() {
        if (waInput.value === "") {
          waInput.value = "wa.me/62";
        }
      });
    });
  </script>

</body>

</html>