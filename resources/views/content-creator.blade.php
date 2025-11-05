<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Content Creator - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"
  >
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
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
      <h2>Daftar Content Creator</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>List Content Creator</h3>

        @if(session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Link Profile TikTok</th>
              <th>Username Discord</th>
              <th>Followers</th>
              <th>Tanggal Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contentCreators as $contentCreator)
              <tr>
                <td>{{ $contentCreator->id }}</td>
                <td><a href="{{ $contentCreator->tiktok }}" target="_blank">Lihat TikTok</a></td>
                <td>{{ $contentCreator->discord }}</td>
                <td>{{ $contentCreator->followers }}</td>
                <td>{{ $contentCreator->created_at->format('d M Y') }}</td>
                <td>
                  <div class="actions">
                    <!-- Lihat detail Content Creator -->

                    <a href="{{ route('content-creator.verify', $contentCreator->id) }}" class="btn btn-verify">Verifikasi</a>
                    <!-- Form untuk menghapus Content Creator -->
                    <form action="{{ route('content-creator.destroy', $contentCreator->id) }}" method="POST" style="display:inline;">
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
