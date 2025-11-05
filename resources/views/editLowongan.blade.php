<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Lowongan - NDEV Studio</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/editLowongan.css') }}">
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
      <h2>Edit Lowongan</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="form-container">
        <h3>Form Edit Lowongan</h3>

        <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST">
          @csrf
          @method('PUT')

          <label for="judul">Judul:</label>
          <input type="text" id="judul" name="judul" value="{{ $lowongan->judul }}" required>

          <label for="mulai">Tanggal Mulai:</label>
          <input type="date" id="mulai" name="mulai" value="{{ $lowongan->mulai }}" required>

          <label for="selesai">Tanggal Selesai:</label>
          <input type="date" id="selesai" name="selesai" value="{{ $lowongan->selesai }}" required>

          <label for="deskripsi">Deskripsi:</label>
          <textarea id="deskripsi" name="deskripsi" required>{{ $lowongan->deskripsi }}</textarea>

          

          <button type="submit" class="btn-submit">Update</button>
        </form>
      </div>
    </section>
  </div>
</body>
</html>
