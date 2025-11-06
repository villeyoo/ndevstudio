<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Robux - NDEV Studio</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/tambahLow.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>

<body>

  <style>
    select {
      background-color: #1a1a1a;
      /* warna hitam */
      color: #fff;
      /* teks putih */
      border: 1px solid #444;
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      outline: none;
    }

    select option {
      background-color: #1a1a1a;
      /* warna hitam untuk dropdown */
      color: #fff;
    }

    /* Saat di-hover */
    select option:hover {
      background-color: #333;
    }
  </style>
  @include('sidebar')

  <div class="main">
    <header class="topbar">
      <h2>Tambah Robux</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="form-container">
        <h3>Form Tambah Harga Robux</h3>

        @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px;border-radius:8px;margin-bottom:15px;">
          {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="errors">
          <ul>
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
        @endif


        <form action="{{ route('product.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="title">Jumlah Robux</label>
            <input type="text" id="title" name="title" placeholder="Contoh: 1.000 ROBUX" required>
          </div>

          <div class="form-group">
            <label for="price">Harga Robux</label>
            <input type="text" id="price" name="price" placeholder="Contoh: Rp 50.000" required>
          </div>

          <!-- ✅ Dropdown Jenis Pengiriman -->
          <div class="form-group">
            <label for="type">Jenis Pengiriman</label>
            <select id="type" name="type" required>
              <option value="" disabled selected>Pilih jenis pengiriman</option>
              <option value="instant">Instant</option>
              <option value="pending">Pending</option>
            </select>
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
    // Fungsi format angka dengan titik (1.000, 10.000, dst)
    function formatNumber(value) {
      return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // --- Input Jumlah Robux ---
    const titleInput = document.getElementById('title');
    titleInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, ''); // hapus non-digit
      if (value) {
        e.target.value = formatNumber(value) + ' ROBUX';
      } else {
        e.target.value = '';
      }
    });

    // --- Input Harga Robux ---
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, ''); // hanya angka
      if (value) {
        e.target.value = 'Rp ' + formatNumber(value);
      } else {
        e.target.value = '';
      }
    });

    // --- Bersihkan format saat form disubmit ---
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
      titleInput.value = titleInput.value.replace(/\D/g, '');
      priceInput.value = priceInput.value.replace(/\D/g, '');
    });
  </script>

</body>

</html>