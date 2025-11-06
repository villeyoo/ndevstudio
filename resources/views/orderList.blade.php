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

        @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if($orders->isEmpty())
        <p>Belum ada pesanan masuk.</p>
        @else
        <div class="cards">
          @foreach($orders as $order)
          <div class="card">
            <h4>Pesanan #{{ $order->id }}</h4>
            <p>🕓 <strong>{{ $order->created_at->format('l, d M Y - H:i') }}</strong></p>
            <hr>

            <p>👤 <strong>Username:</strong> {{ $order->username }}</p>
            <p>📱 <strong>WhatsApp:</strong>
              <a href="https://{{ $order->whatsapp }}" target="_blank">
                {{ $order->whatsapp }}
              </a>
            </p>

            @if($order->product)
            <p>🎮 <strong>Produk:</strong> {{ $order->product->title }}</p>
            @php
            $cleanPrice = preg_replace('/[^0-9]/', '', $order->product->price);
            @endphp
            <p>💰 <strong>Harga:</strong> Rp {{ number_format((int)$cleanPrice, 0, ',', '.') }}</p>

            @endif

            <p>💳 <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
            <p>📦 <strong>Status:</strong>
              <span class="status 
                {{ $order->status === 'pending' ? 'status-pending' : '' }}
                {{ $order->status === 'success' ? 'status-success' : '' }}
                {{ $order->status === 'failed' ? 'status-failed' : '' }}">
                {{ ucfirst($order->status) }}
              </span>
            </p>

            <div class="actions">
              <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-verify" onclick="return confirm('Tandai pesanan ini sebagai selesai?')">Selesai</button>
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