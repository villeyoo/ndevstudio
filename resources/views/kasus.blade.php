<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Bukti Kasus - NDEV Studio</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">

  <style>
    select,
    select option {
      color: #000;
    }

    .form-group input[type="file"] {
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 6px;
      background-color: #fff;
      width: 100%;
    }

    #bukti-preview img,
    #bukti-preview video {
      max-width: 300px;
      display: block;
      margin-top: 10px;
      border-radius: 8px;
    }
  </style>
</head>

<body>
  @include('sidebarAdmin')

  <div class="main">
    <header class="topbar">
      <h2>Tambah Bukti Kasus</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="form-container">
        <h3>Form Penambahan Bukti Kasus Nyata</h3>

        {{-- Error Messages --}}
        @if ($errors->any())
        <div class="errors">
          <ul>
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {{-- FORM --}}
        <form id="kasus-form" action="{{ route('kasus.store') }}" method="POST" enctype="multipart/form-data">

          @csrf

          <div class="form-group">
            <label for="judul">Judul Kasus</label>
            <input type="text" id="judul" name="judul" placeholder="Contoh: Perampokan Minimarket" required>
          </div>

          <div class="form-group">
            <label for="tanggal">Tanggal Kejadian</label>
            <input type="date" id="tanggal" name="tanggal" required>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan kronologi singkat..." required></textarea>
          </div>

          <div class="form-group">
            <label for="bukti">Upload Bukti (Foto/Video)</label>
            <input type="file" id="bukti" name="bukti" accept="image/*,video/*" required>
            <div id="bukti-preview"></div>
          </div>

          <div class="form-group">
            <label for="pelapor">Dilaporkan Oleh</label>
            <input type="text" id="pelapor" name="pelapor" value="{{ Auth::user()->username }}" required>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Bukti</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Kembali</a>
          </div>
        </form>
      </div>
    </section>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById('bukti');

      fileInput.addEventListener('change', function() {
        const preview = document.getElementById('bukti-preview');
        preview.innerHTML = '';

        if (fileInput.files.length > 0) {
          const file = fileInput.files[0];

          if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            preview.appendChild(img);
          } else if (file.type.startsWith('video/')) {
            const vid = document.createElement('video');
            vid.controls = true;
            vid.src = URL.createObjectURL(file);
            preview.appendChild(vid);
          }
        }
      });
    });
  </script>

</body>

</html>