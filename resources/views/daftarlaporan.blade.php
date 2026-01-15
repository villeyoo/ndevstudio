<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Owner - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
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
      <h2>Data Laporan</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>

      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="cards">
        <div class="card">
          <h3>Total Laporan</h3>
          <p class="count">{{ $totalLaporan }}</p>
        </div>
      </div>

      <div class="panel">
        <h3>Daftar Laporan Terbaru</h3>
        <ul class="laporan-list">
          @forelse($laporans as $lapor)
          <li>
            <div class="laporan-header">
              <h4>{{ $lapor->kategori }} - {{ $lapor->nama ?? 'Anonim' }}</h4>
              <span class="status-box
                  {{ $lapor->status == 'PENDING' ? 'status-pending' :
                     ($lapor->status == 'DITERIMA' ? 'status-diterima' :
                     ($lapor->status == 'DIPROSES' ? 'status-diproses' :
                     ($lapor->status == 'SELESAI' ? 'status-selesai' : 'status-ditolak'))) }}">
                {{ $lapor->status }}
              </span>
            </div>

            <div class="laporan-isi">{{ $lapor->isi }}</div>

            @if($lapor->attachment && \Illuminate\Support\Facades\Storage::disk('public')->exists($lapor->attachment))
            @php
            $fileUrl = asset('storage/' . $lapor->attachment);
            $ext = pathinfo($lapor->attachment, PATHINFO_EXTENSION);
            $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','webp','gif']);
            $isVideo = in_array(strtolower($ext), ['mp4','mov','avi','webm','mkv']);
            @endphp

            <div class="laporan-attachment">
              @if($isImage)
              <a href="{{ $fileUrl }}" target="_blank">
                <img src="{{ $fileUrl }}" alt="bukti">
              </a>
              @elseif($isVideo)
              <a href="{{ $fileUrl }}" target="_blank">
                <video width="120" height="80" muted>
                  <source src="{{ $fileUrl }}" type="video/{{ $ext }}">
                </video>
              </a>
              @endif
            </div>
            @endif

            <div class="laporan-actions">
              @if($lapor->status !== 'SELESAI')
              <form action="{{ route('laporan.selesai', $lapor->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-done" onclick="return confirm('Tandai laporan ini sebagai SELESAI?')">Tandai Selesai</button>
              </form>
              @endif

              @if($lapor->attachment)
              <a href="{{ asset('storage/' . $lapor->attachment) }}" target="_blank" class="btn-view">Lihat</a>
              <a href="{{ route('laporan.download', $lapor->id) }}" class="btn-download">Download</a>
              @endif
            </div>
          </li>
          @empty
          <li>Tidak ada laporan saat ini.</li>
          @endforelse
        </ul>
      </div>
  </div>

  {{-- optional quick styles for the new buttons --}}
  <style>
    .bug-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .bukti-actions {
      display: flex;
      gap: 8px;
      align-items: center;
      margin-right: 8px;
    }

    .btn-view,
    .btn-download {
      display: inline-block;
      padding: 6px 10px;
      background: #0b74de;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      font-size: 13px;
    }

    .btn-download {
      background: #26a65b;
    }

    .btn-view:hover,
    .btn-download:hover {
      opacity: 0.9;
    }

    .reported-by {
      margin-top: 6px;
      color: #333;
      font-size: 14px;
    }

    .no-bukti {
      color: #777;
      font-size: 13px;
    }
  </style>



  </ul>
  </div>
  </section>
  </div>
</body>

</html>