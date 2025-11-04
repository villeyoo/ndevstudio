<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pendaftar Scripter - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/lowonganList.css') }}">
   <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  <!-- Sidebar -->
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Daftar Pendaftar Scripter</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>List Pendaftar Scripter</h3>

        @if(session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Username Roblox</th>
              <th>Username Discord</th>
              <th>Alasan Menjadi Scripter</th>
              <th>Portofolio</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($scripters as $scripter)
              <tr>
                <td>{{ $scripter->id }}</td>
                <td>{{ $scripter->roblox }}</td>
                <td>{{ $scripter->discord }}</td>
                <td>{{ Str::limit($scripter->reason, 50) }}</td>
                <td><a href="{{ $scripter->portfolio ?? '#' }}" target="_blank">{{ $scripter->portfolio ? 'Lihat Portofolio' : 'Tidak Ada' }}</a></td>
                <td>{{ ucfirst($scripter->status) }}</td>
                <td>
                  <div class="actions">
                 <a href="{{ route('scripter.verify', $scripter->id) }}" class="btn btn-verify">Verifikasi</a>
                    <form action="{{ route('scripter.destroy', $scripter->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </div>
</body>
</html>
