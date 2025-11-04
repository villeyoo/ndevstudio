<div class="sidebar">
  <div class="sidebar-header">
    <h3 class="logo">Ndev Studio</h3>
  </div>

  <ul class="menu">
    <li><a href="{{ route('dashboard') }}" class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <i class="fa-solid fa-house"></i>
      <span>Dashboard</span>
    </a></li>

    <li><a href="{{ route('robux.form') }}" class="menu-item">
      <i class="fa-solid fa-plus"></i>
      <span>Exchange Robux</span>
    </a></li>
    <li>
  <a href="{{ route('robux.track.form') }}" class="menu-item">
    <i class="fa-solid fa-search"></i>
    <span>Track Robux</span>
  </a>
</li>

    <li><a href="{{ route('bug.index') }}" class="menu-item">
      <i class="fa-solid fa-bug"></i>
      <span>Tambah Bug</span>
    </a></li>
  </ul>

  <form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i>
      <span>Logout</span>
    </button>
  </form>
</div>

<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a2e0e6b9d4.js" crossorigin="anonymous"></script>
