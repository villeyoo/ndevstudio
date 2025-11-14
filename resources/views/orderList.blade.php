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
      <h2>Daftar Order Robux</h2>
      <div class="profile">
        <img src="{{ asset('assets/images/viel.png') }}" alt="profile">
        <span>{{ Auth::user()->username }}</span>
      </div>
    </header>

    <section class="content">
      <div class="table-container">
        <h3>List Pesanan Robux</h3>

        <!-- Search -->
        <form method="GET" class="search-box" style="margin-bottom: 20px;">
          <input
            type="text"
            name="search"
            placeholder="Cari username..."
            value="{{ request('search') }}"
            class="search-input">
          <button type="submit" class="search-btn">Cari</button>
        </form>

        <!-- Flash -->
        @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
        @endif

        <!-- Orders -->
        @if($orders->isEmpty())
        <p>Belum ada pesanan masuk.</p>
        @else

        @php
        // Filter collection di server-side (blade) berdasarkan query 'search'
        $filteredOrders = $orders;
        if(request('search')) {
        $filteredOrders = $orders->filter(function($o){
        return stripos($o->username, request('search')) !== false;
        });
        }
        @endphp

        @if($filteredOrders->isEmpty())
        <p>Tidak ada pesanan dengan username tersebut.</p>
        @else
        <div class="cards">
          @foreach($filteredOrders as $order)
          <div class="card">
            <h4>Pesanan #{{ $order->id }}</h4>
            <p>🕓 <strong>{{ $order->created_at->format('l, d M Y - H:i') }}</strong></p>
            <hr>

            <p>👤 <strong>Username:</strong> {{ $order->username }}</p>

            <p>📱 <strong>WhatsApp:</strong>
              <a href="https://{{ $order->whatsapp }}" target="_blank" rel="noopener">
                {{ $order->whatsapp }}
              </a>
            </p>

            {{-- Tampilkan produk jika relasi ada --}}
            @if($order->product)
            <p>🎮 <strong>Produk:</strong> {{ $order->product->title }}</p>

            @php
            $cleanPrice = preg_replace('/[^0-9]/', '', $order->product->price);
            @endphp

            <p>💰 <strong>Harga:</strong> Rp {{ number_format((int)$cleanPrice, 0, ',', '.') }}</p>
            @endif

            <p>💳 <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>

            <p>📦 <strong>Status:</strong>
              <span class="status-robux
                {{ $order->status === 'pending' ? 'status-pending-box' : '' }}
                {{ $order->status === 'success' ? 'status-success-box' : '' }}">
                @if($order->status === 'pending')
                Pesanan Belum Diproses
                @elseif($order->status === 'success')
                Selesai
                @else
                {{ ucfirst($order->status) }}
                @endif
              </span>
            </p>

            {{-- GAMEPASS ID untuk pesanan pending --}}
            @if($order->product && strtolower($order->product->type) === 'pending')
            <p>🔢 <strong>Gamepass ID:</strong>
              @if($order->gamepass_id)
              {{ $order->gamepass_id }}
              @else
              <em style="color:#c05621">Belum diisi</em>
              @endif
            </p>
            @endif

            <div class="actions">
              <form action="{{ route('order.complete', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-verify" onclick="return confirm('Tandai pesanan ini sebagai selesai?')">
                  Selesai
                </button>
              </form>

              <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline; margin-left:8px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Hapus pesanan ini?')">Hapus</button>
              </form>
            </div>

          </div>
          @endforeach
        </div>
        @endif {{-- end filteredOrders empty check --}}

        @endif {{-- end orders isEmpty check --}}

      </div>
    </section>
  </div>
</body>

</html>