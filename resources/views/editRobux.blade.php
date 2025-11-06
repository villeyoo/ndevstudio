<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Robux - NDEV Studio</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/listRobux.css') }}">

  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>
<body>
  @include('sidebar')

  <div class="main">
    <!-- Navbar -->
    <header class="topbar">
      <h2>Edit Harga Robux</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <!-- Content -->
    <section class="content">
      <div class="table-container">
        <h3>Form Edit Robux</h3>

        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('product.update', $product->id) }}" method="POST" style="display:flex;flex-direction:column;gap:15px;">
          @csrf
          @method('PUT')

          <label for="title">Judul Robux:</label>
          <input type="text" id="title" name="title" value="{{ $product->title }}" required
            style="padding:10px 14px;border:none;border-radius:10px;outline:none;font-size:0.95rem;background:rgba(255,255,255,0.9);">

          <label for="price">Harga Robux:</label>
          <input type="number" id="price" name="price" value="{{ $product->price }}" required
            style="padding:10px 14px;border:none;border-radius:10px;outline:none;font-size:0.95rem;background:rgba(255,255,255,0.9);">

          <div style="margin-top:15px;display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn-verify">Update</button>
            <a href="{{ route('product.index') }}" class="btn-delete" style="text-decoration:none;">Batal</a>
          </div>
        </form>
      </div>
    </section>
  </div>
</body>
</html>
