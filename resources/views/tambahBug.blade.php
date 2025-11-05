<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Bug - NDEV Studio</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">

  <style>
    select, select option { color: #000; }
    .form-group input[type="file"] {
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 6px;
      background-color: #fff;
      width: 100%;
    }
    #bukti-preview img, #bukti-preview video { max-width: 300px; display:block; margin-top:10px; }
  </style>
</head>

<body>
  @include('sidebarAdmin')

  <div class="main">
    <header class="topbar">
      <h2>Tambah Bug</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="form-container">
        <h3>Form Laporan Bug</h3>

        @if ($errors->any())
          <div class="errors">
            <ul>
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form id="bug-form" action="{{ route('bug.create') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="judul">Judul Bug</label>
            <input type="text" id="judul" name="judul" placeholder="Contoh: Pohon Terbang" value="{{ old('judul') }}" required>
          </div>

          <div class="form-group">
            <label for="dilaporkan_oleh">Dilaporkan Oleh (Isi sesuai usn roblox) </label>
            <input type="text" id="dilaporkan_oleh" name="dilaporkan_oleh" value="{{ old('dilaporkan_oleh', Auth::user()->username) }}" required>
          </div>

          <div class="form-group">
            <label for="prioritas">Prioritas</label>
            <select id="prioritas" name="prioritas" required>
              <option value="">-- Pilih Prioritas --</option>
              <option value="Low" {{ old('prioritas')=='Low' ? 'selected' : '' }}>Low</option>
              <option value="Medium" {{ old('prioritas')=='Medium' ? 'selected' : '' }}>Medium</option>
              <option value="High" {{ old('prioritas')=='High' ? 'selected' : '' }}>High</option>
              <option value="Critical" {{ old('prioritas')=='Critical' ? 'selected' : '' }}>Critical</option>
            </select>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi Bug</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="" required>{{ old('deskripsi') }}</textarea>
          </div>

          <div class="form-group">
            <label for="tanggal">Tanggal Ditemukan</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
          </div>

          <div class="form-group">
            <label for="bukti">Upload Bukti (Foto/Video)</label>
            <input type="file" id="bukti" name="bukti" accept="image/*,video/*" required>
            <div id="bukti-preview"></div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="{{ route('dashboard') }}" class="btn-back">Kembali</a>
          </div>
        </form>
      </div>
    </section>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('bukti');
    const form = document.getElementById('bug-form');
    fileInput.addEventListener('change', function () {
      console.log('fileInput.files:', fileInput.files);
      const preview = document.getElementById('bukti-preview');
      preview.innerHTML = '';
      if (fileInput.files && fileInput.files.length > 0) {
        const file = fileInput.files[0];
        console.log('Selected file:', file.name, file.type, file.size);
        if (file.type.startsWith('image/')) {
          const img = document.createElement('img');
          img.src = URL.createObjectURL(file);
          preview.appendChild(img);
        } else if (file.type.startsWith('video/')) {
          const v = document.createElement('video');
          v.controls = true;
          v.src = URL.createObjectURL(file);
          preview.appendChild(v);
        }
      }
    });

    form.addEventListener('submit', function (ev) {
      // lihat FormData di console sebelum submit
      const fd = new FormData(form);
      for (let pair of fd.entries()) {
        console.log(pair[0], pair[1]);
      }
    });
  });
  </script>
</body>
</html>
