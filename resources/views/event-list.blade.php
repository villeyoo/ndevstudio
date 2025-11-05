<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Peserta Event - NDEV Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/lowonganList.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Daftar Peserta Event</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>Admin</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>List Submission Event</h3>

        {{-- pesan sukses --}}
        @if(session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Discord Username</th>
              <th>Link Video</th>
              <th>Tanggal Submit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($submissions as $s)
              <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->discord_username }}</td>
                <td>
                  <a href="{{ $s->video_link }}" target="_blank" rel="noopener noreferrer">
                    {{ Str::limit($s->video_link, 60) }}
                  </a>
                </td>
                <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
                <td>
                  <form action="{{ route('submissions.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">Belum ada peserta yang mendaftar.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div class="pagination">
          {{ $submissions->links() }}
        </div>
      </div>
    </section>
  </div>
</body>
</html>
