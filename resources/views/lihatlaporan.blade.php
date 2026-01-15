<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Laporan - NDEV Studio</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>

<body>
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Manajemen Laporan</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">

      @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
      @endif

      @if($laporans->isEmpty())
      <p>Tidak ada laporan masuk.</p>
      @else
      <div class="cards">
        @foreach($laporans as $lapor)
        <div class="card">

          <div class="card-header">
            <h4>{{ $lapor->kategori }}</h4>
            <span class="status 
                        
                            {{ $lapor->status == 'PENDING' ? 'status-pending' :
                               ($lapor->status == 'DIPROSES' ? 'status-process' :
                                ($lapor->status == 'DITERIMA' ? 'status-diterima' :
                               ($lapor->status == 'SELESAI' ? 'status-done' : 'status-reject'))) }}">
              {{ $lapor->status }}
            </span>
          </div>

          <p><strong>Nama:</strong> {{ $lapor->nama ?? 'Anonim' }}</p>
          <p><strong>Kontak:</strong> {{ $lapor->kontak ?? '-' }}</p>

          <p class="laporan-isi">
            {{ Str::limit($lapor->isi, 120) }}
          </p>

          <small>Dikirim: {{ $lapor->created_at->format('d M Y H:i') }}</small>

          @if($lapor->attachment)
          <div class="lampiran">
            <a href="{{ asset('storage/'.$lapor->attachment) }}" target="_blank">
              📎 Lihat Lampiran
            </a>
          </div>
          @endif

          <div class="card-actions">

            <!-- DETAIL -->
            <a href="{{ route('admin.laporan.detail', $lapor->id) }}" class="btn-view">
              Detail
            </a>

            <!-- UPDATE STATUS -->
            <form action="{{ route('admin.laporan.status', $lapor->id) }}" method="POST">
              @csrf
              <select name="status" onchange="this.form.submit()">
                <option disabled selected>Ubah Status</option>
                <option value="PENDING">Pending</option>
                <option value="DIPROSES">Diproses</option>
                <option value="SELESAI">Selesai</option>
                <option value="DITOLAK">Ditolak</option>
              </select>
            </form>

            <form action="{{ route('admin.laporan.delete', $lapor->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Hapus laporan ini? File attachment juga akan dihapus!')" class="btn-delete">
                Hapus
              </button>
            </form>


          </div>
        </div>
        @endforeach
      </div>
      @endif
    </section>
  </div>

</body>

</html>