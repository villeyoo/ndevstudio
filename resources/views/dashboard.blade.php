<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Owner - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
      <h2>Dashboard</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>

      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="cards">
        <div class="card">
          <h3>Total Lowongan</h3>
           <p class="count">{{ $totalLowongan }}</p>
        </div>
        <div class="card">
          <h3>Pengajuan Content Creator</h3>
            <p class="count">{{ $totalContentCreator }}</p>
        </div>
          <div class="card">
          <h3>Pengajuan Scripter</h3>
            <p class="count">{{ $totalScripter }}</p>
        </div>
          <div class="card">
          <h3>Pengajuan Polisi</h3>
            <p class="count">{{ $totalPolisi }}</p>
        </div>
      </div>

         <div class="panel">
  <h3>Daftar Bug</h3>
  <ul class="bug-list">
    @forelse($bugs as $bug)
      <li>
        <div>
          <strong>{{ $bug->judul }}</strong>

          <!-- Dilaporkan Oleh -->
          <div class="reported-by">
            Dilaporkan oleh: <strong>{{ $bug->dilaporkan_oleh ?? 'Unknown' }}</strong>
          </div>

          <div class="desc">{{ $bug->deskripsi }}</div>

          <small class="date">
            Prioritas:
            <span class="prio {{ strtolower($bug->prioritas) }}">
              {{ $bug->prioritas }}
            </span>
            |
            {{ \Carbon\Carbon::parse($bug->tanggal)->format('d M Y') }}
          </small>
        </div>

        <div class="bug-actions">
          {{-- Tombol lihat / download bukti jika ada --}}
          @if(!empty($bug->bukti) && \Illuminate\Support\Facades\Storage::disk('public')->exists($bug->bukti))
            @php
              $fileUrl = asset('storage/' . $bug->bukti);
              $ext = pathinfo($bug->bukti, PATHINFO_EXTENSION);
              $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','webp','gif']);
              $isVideo = in_array(strtolower($ext), ['mp4','mov','avi','webm','mkv']);
            @endphp

            <div class="bukti-actions">
              <!-- Preview kecil (gambar/video) -->
              @if($isImage)
                <a href="{{ $fileUrl }}" target="_blank" title="Buka bukti">
                  <img src="{{ $fileUrl }}" alt="bukti" style="max-width:80px; max-height:60px; object-fit:cover; border-radius:4px;">
                </a>
              @elseif($isVideo)
                <a href="{{ $fileUrl }}" target="_blank" title="Buka bukti (video)">
                  <video width="120" height="60" muted>
                    <source src="{{ $fileUrl }}" type="video/{{ $ext }}">
                    Your browser does not support the video tag.
                  </video>
                </a>
              @endif

              <!-- Buttons -->
              <a href="{{ $fileUrl }}" target="_blank" class="btn-view">Lihat</a>
             <a href="{{ route('bugs.download', $bug->id) }}" class="btn-download">Download</a>

            </div>
          @else
            <div class="no-bukti">Tidak ada bukti terlampir</div>
          @endif

          <!-- Tombol hapus (tetap ada) -->
          <form action="{{ route('bugs.delete', $bug->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="done" onclick="return confirm('Tandai selesai & hapus?')">
              Selesai
            </button>
          </form>
        </div>
      </li>
    @empty
      <li>Tidak ada bug yang tercatat.</li>
    @endforelse
  </ul>
</div>

{{-- optional quick styles for the new buttons --}}
<style>
  .bug-actions { display:flex; gap:8px; align-items:center; }
  .bukti-actions { display:flex; gap:8px; align-items:center; margin-right:8px; }
  .btn-view, .btn-download {
    display:inline-block;
    padding:6px 10px;
    background:#0b74de;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
  }
  .btn-download { background:#26a65b; }
  .btn-view:hover, .btn-download:hover { opacity:0.9; }
  .reported-by { margin-top:6px; color:#333; font-size:14px; }
  .no-bukti { color:#777; font-size:13px; }
</style>


          
        </ul>
      </div>
    </section>
  </div>
</body>
</html>
