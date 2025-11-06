<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Lowongan - NDEV Studio</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/verifyRobux.css') }}">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/viel.png') }}">
</head>

<body>
  <div class="form-container">
    <h2>Verifikasi Permintaan Robux</h2>
    <p><strong>Username Roblox:</strong> {{ $req->username }}</p>
    <p><strong>Requested by:</strong> {{ $req->requested_by }}</p>

    <form action="{{ route('robux.updateVerification', $req->id) }}" method="POST">
      @csrf
      @method('PUT')

      <label>Status</label>
      <select name="status" required>
        <option value="verified">Diverifikasi</option>
        <option value="rejected">Ditolak</option>
      </select>

      <label>Catatan (opsional)</label>
      <textarea name="notes" rows="4" placeholder="Tambahkan keterangan...">{{ $req->notes ?? '' }}</textarea>

      <button type="submit">Simpan Verifikasi</button>
    </form>
  </div>
</body>

</html>