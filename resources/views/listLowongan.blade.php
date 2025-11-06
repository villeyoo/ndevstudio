<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Lowongan - NDEV Studio</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/lowonganList.css') }}">
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
      <h2>Tambah Lowongan</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="table-container">
        <h3>List Lowongan</h3>

        <!-- Alert Success -->
        @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
        @endif

        <!-- Table -->
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Judul</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lowongans as $lowongan)
            <tr>
              <td data-label="ID">{{ $lowongan->id }}</td>
              <td data-label="Judul">{{ $lowongan->judul }}</td>
              <td data-label="Mulai">{{ $lowongan->mulai }}</td>
              <td data-label="Selesai">{{ $lowongan->selesai }}</td>
              <td data-label="Deskripsi">{{ Str::limit($lowongan->deskripsi, 50) }}</td>
              <td data-label="Aksi">
                <div class="actions">
                  <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-edit">Edit</a>
                  <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin hapus?')">Delete</button>
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