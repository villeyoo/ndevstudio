<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Pengajuan Content Creator - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/verif.css') }}"> <!-- Pastikan link CSS ini digunakan -->
   <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  <!-- Sidebar -->
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Verifikasi Pengajuan Content Creator</h2>
    </header>

    <section class="content">
      <div class="verif-card">
        <h3>Apakah Anda yakin ingin menerima atau menolak pengajuan ini?</h3>

        <div class="verif-card-body">
          <!-- Tampilkan informasi yang relevan untuk Content Creator -->
          <div class="verif-info-item">
            <p><strong>Nama:</strong> {{ $contentCreator->discord }}</p>
          </div>
          <div class="verif-info-item">
            <p><strong>Link TikTok:</strong> <a href="{{ $contentCreator->tiktok }}" target="_blank">Lihat TikTok</a></p>
          </div>
          <div class="verif-info-item">
            <p><strong>Followers:</strong> {{ $contentCreator->followers }}</p>
          </div>
          <div class="verif-info-item">
            <p><strong>Pengajuan Tanggal:</strong> {{ $contentCreator->created_at->format('d M Y') }}</p>
          </div>

          <!-- Form untuk menerima atau menolak pengajuan -->
          <form action="{{ route('content-creator.updateStatus', $contentCreator->id) }}" method="POST" class="verif-status-form">
            @csrf
            @method('PUT')

            <label for="status">Pilih Status:</label>
            <select name="status" id="status" required>
              <option value="diterima">Diterima</option>
              <option value="ditolak">Ditolak</option>
            </select>

            <!-- Button type submit untuk mengonfirmasi status -->
            <div class="button-group">
              <button type="submit" class="verif-btn-confirm">Konfirmasi</button>
              <button type="button" class="verif-btn-cancel" onclick="window.location.href='{{ route('content-creator.index') }}'">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
