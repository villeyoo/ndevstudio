<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Lowongan - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
   <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  <!-- Sidebar -->
  @include('sidebar')

  <!-- Main Content -->
  <div class="main">
    <!-- Navbar -->
    <header class="topbar">
      <h2>Tambah Lowongan</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="form-container">
        <h3>Form Tambah Lowongan</h3> 
        <form action="{{ route('lowongan.create') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="judul">Judul Lowongan</label>
            <input type="text" id="judul" name="judul" placeholder="Contoh: Scripter" required>
          </div>

          <div class="form-group">
            <label for="mulai">Tanggal Mulai</label>
            <input type="date" id="mulai" name="mulai" required>
          </div>

          <div class="form-group">
            <label for="selesai">Tanggal Selesai</label>
            <input type="date" id="selesai" name="selesai" required>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi Pekerjaan</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Detail" required></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="{{ route('dashboard') }}">
              <button type="button" class="btn-back">Kembali</button>
            </a>
          </div>
        </form>
      </div>
    </section>
  </div>
</body>
</html>
