<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NDEV Studio</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/daftar.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
     <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
    <!-- Navbar -->
 

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Daftar Posisi Yang Tersedia!<br></h1>
            <p>saat ini posisi yang tersedia hanya scripter dan klaim title content creator</p>
            <p>jika kamu mendaftar selain scripter akan otomatis di tolak!</p>
            
        </div>
        <div class="hero-image">
            <img src="{{ asset('assets/images/viel.svg') }}" alt="maskot" class="maskot">
        </div>
    </section>

    <!-- Stats Section -->
    <section class="kotak">
    <!-- Tab Buttons -->
    <div class="tab-buttons">
        <button class="tab-btn active" data-tab="creator">Konten Creator</button>
        <button class="tab-btn" data-tab="programmer">Scripter</button>
        <button class="tab-btn" data-tab="designer">Polisi</button>
    </div>

    <!-- Tab Forms -->

    <!-- Konten Creator -->
  <form action="{{ route('content-creator.store') }}" method="POST" id="creator" class="tab-form active">
    @csrf
    <label>Link Profile TikTok:</label>
    <input class="masukan" type="url" name="tiktok" placeholder="https://www.tiktok.com/@username" required>

    <label>Username Discord:</label>
    <input class="masukan" type="text" name="discord" placeholder="Username#1234" required>

    <label>Jumlah Followers:</label>
    <input class="masukan" type="number" name="followers" placeholder="Jumlah followers" required>

    <button type="submit">Ajukan</button>
</form>


    <!-- Scripter -->
    <form action="{{ route('pelamar.scripter') }}" method="POST" id="programmer" class="tab-form">
    @csrf
    <label>Username Roblox:</label>
    <input type="text" name="roblox" required>

    <label>Username Discord:</label>
    <input type="text" name="discord" required>

    <label>Alasan ingin menjadi Scripter:</label>
    <textarea name="reason" required></textarea>

    <label>Jelaskan pengalaman mu di dunia coding:</label>
    <textarea name="experience" required></textarea>

     <label>Portofolio (Opsional):</label>
    <input type="url" name="portfolio" placeholder="https://example.com">
    

    <button type="submit">Daftar Sekarang</button>
</form>


    <!-- Polisi -->
 <form action="{{ route('pelamar.polisi') }}" method="POST" id="designer" class="tab-form">
    @csrf
    <label>Username Roblox:</label>
    <input type="text" name="roblox" required>

    <label>Username Discord:</label>
    <input type="text" name="discord" required>

    <label>Alasan ingin menjadi Polisi:</label>
    <textarea name="reason" required></textarea>

    <button type="submit">Daftar Sekarang</button>
</form>


    </section>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/daftar.js') }}"></script>
</body>
</html>
