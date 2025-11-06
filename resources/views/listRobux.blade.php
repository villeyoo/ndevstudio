<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Robux - NDEV Studio</title>

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
    <header class="topbar">
      <h2>Daftar Harga Robux</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>List Robux</h3>

        @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if($products->isEmpty())
        <p>Belum ada data robux yang ditambahkan.</p>
        @else
        <div class="cards">
          @foreach($products as $product)
          <div class="card">
            <h4>{{ $product->title }}</h4>
            @php
            $isRupiah = Str::contains(strtolower($product->title), ['rp', 'rupiah', 'idr']);
            @endphp
            <p>
              Harga:
              <strong>
                {{ $isRupiah ? 'Rp ' . number_format($product->price, 0, ',', '.') : $product->price . ' Robux' }}
              </strong>
            </p>

            <div>
              <a href="{{ route('product.edit', $product->id) }}" class="btn-verify">Edit</a>

              <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Hapus robux ini?')">Hapus</button>
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