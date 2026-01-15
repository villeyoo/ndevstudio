<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Pengajuan Polisi - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/verif.css') }}">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">

</head>

<body>
  <!-- Sidebar -->
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Detail Laporan</h2>
    </header>

    <div class="laporan-detail-wrapper">

      <div class="laporan-card">
        <div class="laporan-header">
          <h2>Detail Laporan</h2>

          @php
          $statusClass = [
          'PENDING' => 'status-pending',
          'DIPROSES' => 'status-process',
          'DITERIMA' => 'status-diterima',
          'SELESAI' => 'status-done',
          'DITOLAK' => 'status-reject',
          ];
          @endphp

          <span class="status-badge {{ $statusClass[$laporan->status] ?? 'status-pending' }}">
            {{ $laporan->status }}
          </span>
        </div>

        <div class="laporan-body">
          <div class="laporan-row">
            <span>Nama Pelapor</span>
            <p>{{ $laporan->nama }}</p>
          </div>

          <div class="laporan-row">
            <span>Kontak</span>
            <p>{{ $laporan->kontak }}</p>
          </div>

          <div class="laporan-row">
            <span>Kategori Laporan</span>
            <p>{{ $laporan->kategori }}</p>
          </div>

          <div class="laporan-row">
            <span>Isi Laporan</span>
            <p class="laporan-isi">{{ $laporan->isi }}</p>
          </div>

          @if($laporan->bukti)
          <div class="laporan-row">
            <span>Bukti</span>
            <img src="{{ asset('storage/'.$laporan->bukti) }}" class="laporan-img">
          </div>
          @endif
        </div>

        <div class="laporan-footer">
          <a href="{{ route('admin.laporan') }}" class="btn-back">← Kembali</a>
        </div>
      </div>

    </div>
  </div>
</body>

</html>