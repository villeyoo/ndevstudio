<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Track Robux - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/permintaanList.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
  <style>
    .lookup-box { max-width:700px; margin:30px auto; }
    .result {
      margin-top:18px;
      background:#fff; border-radius:12px; padding:18px; box-shadow:0 8px 28px rgba(0,0,0,0.08);
    }
    .result .badge { display:inline-block; padding:6px 10px; border-radius:999px; font-weight:700; }
    .badge-pending { background:#fffbeb; color:#b45309; }
    .badge-verified { background:#ecfdf5; color:#15803d; }
    .badge-rejected { background:#fff1f2; color:#b91c1c; }
    .muted { color:#6b7280; font-size:0.95rem; }
    .note { margin-top:12px; padding:12px; background:#f8fafc; border-radius:8px; color:#0f172a; }
  </style>
</head>
<body>
  @include('sidebarAdmin')

  <div class="main">
    <header class="topbar">
      <h2>Track Robux</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="lookup-box">
        @if(session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px;">
            {{ session('error') }}
          </div>
        @endif

        <div class="form-container">
          <h3>Cari Status Permintaan Robux</h3>

          <form action="{{ route('robux.track') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="username">Username Roblox</label>
              <input type="text" id="username" name="username" value="{{ old('username', $searched ?? '') }}" placeholder="Masukkan username Roblox" required>
            </div>

            <div class="form-actions" style="margin-top:12px;">
              <button type="submit" class="btn-back">Cari</button>
              <a href="{{ route('dashboard') }}" class="btn-back" style="margin-left:8px;">Kembali</a>
            </div>
          </form>

          {{-- Hasil pencarian --}}
          @isset($result)
            <div class="result">
              <div style="display:flex;align-items:center;gap:12px;justify-content:space-between;">
                <div>
                  <h4 style="margin:0;">{{ $result->username }}</h4>
                  <div class="muted">Requested by: <strong>{{ $result->requested_by }}</strong></div>
                  <div class="muted">Dikirim: {{ $result->created_at->format('d M Y H:i') }}</div>
                </div>

                <div style="text-align:right;">
                  @php
                    $status = $result->status ?? 'pending';
                  @endphp

                  @if($status === 'pending')
                    <span class="badge badge-pending">Pending</span>
                  @elseif($status === 'verified')
                    <span class="badge badge-verified">Diverifikasi</span>
                  @elseif($status === 'rejected')
                    <span class="badge badge-rejected">Ditolak</span>
                  @else
                    <span class="badge badge-pending">{{ ucfirst($status) }}</span>
                  @endif
                </div>
              </div>

              @if(!empty($result->notes))
                <div class="note">
                  <strong>Keterangan owner:</strong>
                  <div style="margin-top:6px;">{{ $result->notes }}</div>
                </div>
              @else
                <div class="note">
                  <strong>Keterangan:</strong>
                  <div style="margin-top:6px; color:#374151;">
                    Belum ada keterangan untuk permintaan ini.
                  </div>
                </div>
              @endif
            </div>
          @endisset
        </div>
      </div>
    </section>
  </div>
</body>
</html>
