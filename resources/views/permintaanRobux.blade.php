<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acc Robux - NDEV Studio</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/permintaanList.css') }}">
   <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  <!-- Sidebar -->
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Daftar Permintaan Robux Staff</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>Permintaan Robux</h3>

        @if(session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        @if($requests->isEmpty())
          <p>Tidak ada permintaan robux saat ini.</p>
        @else
          <div class="cards">
            @foreach($requests as $req)
              <div class="card">
                <h4>{{ $req->username }}</h4>
                <p>Requested by: <strong>{{ $req->requested_by }}</strong></p>
                <small>Dikirim: {{ $req->created_at->format('d M Y H:i') }}</small>

                <p>Status:
                  <span class="status-box 
                    {{ $req->status == 'verified' ? 'status-verified' : 
                      ($req->status == 'rejected' ? 'status-rejected' : 'status-pending') }}">
                    {{ ucfirst($req->status ?? 'pending') }}
                  </span>
                </p>

                <div>
                  @if($req->status === 'pending')
                    <a href="{{ route('robux.verifyForm', $req->id) }}" class="btn-verify">Verifikasi</a>
                  @endif

                  <form action="{{ route('robux.destroy', $req->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-verify btn-delete" onclick="return confirm('Hapus permintaan ini?')">Hapus</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        @endif

      </div>
    </section>
  </div>
</body>
</html>
