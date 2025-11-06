<!-- Tombol Hamburger -->
<button class="hamburger" id="hamburgerBtn">
  <i class="fa-solid fa-bars"></i>
  <span id="hamburgerText">Menu</span>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h3 class="logo">NDEVSTUDIO</h3>
  </div>

  <ul class="menu">

    <!-- DESA INDO SECTION -->
    <li class="menu-section">DESA INDO</li>
    <li><a href="{{ route('dashboard') }}" class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
    <li><a href="{{ route('lowongan.create') }}" class="menu-item"><i class="fa-solid fa-plus"></i> Tambah Lowongan</a></li>
    <li><a href="{{ route('bug.index') }}" class="menu-item"><i class="fa-solid fa-bug"></i> Tambah Bug</a></li>
    <li><a href="{{ route('robux.index') }}" class="menu-item"><i class="fa-solid fa-coins"></i> Permintaan Robux</a></li>
    <li><a href="{{ route('lowongan.list') }}" class="menu-item"><i class="fa-solid fa-list"></i> List Lowongan</a></li>
    <li><a href="{{ route('scripter.index') }}" class="menu-item"><i class="fa-solid fa-code"></i> Scripter</a></li>
    <li><a href="{{ route('polisi.index') }}" class="menu-item"><i class="fa-solid fa-shield-halved"></i> Polisi</a></li>
    <li><a href="{{ route('submissions.index') }}" class="menu-item"><i class="fa-solid fa-flag"></i> Event Desa</a></li>
    <li><a href="{{ route('content-creator.index') }}" class="menu-item"><i class="fa-solid fa-user-pen"></i> Content Creator</a></li>

    <hr class="divider">

    <!-- NDEV STUDIO SECTION -->
    <li class="menu-section">NDEV STUDIO</li>
    <li><a href="{{ route('dashboardNdev') }}" class="menu-item"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
    <li><a href="{{ route('order.index') }}" class="menu-item"><i class="fa-solid fa-bag-shopping"></i> Orderan</a></li>
    <li><a href="{{ route('product.create') }}" class="menu-item"><i class="fa-solid fa-plus"></i> Tambah Robux</a></li>
    <li><a href="{{ route('product.index') }}" class="menu-item"><i class="fa-solid fa-list"></i> List Robux</a></li>

  </ul>

  <!-- Logout -->
  <form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i>
      <span>Logout</span>
    </button>
  </form>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a2e0e6b9d4.js" crossorigin="anonymous"></script>

<!-- Sidebar Script -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const hamburger = document.getElementById('hamburgerBtn');
    const hamburgerText = document.getElementById('hamburgerText');
    const closeBtn = document.getElementById('closeSidebar');

    function openSidebar() {
      sidebar.classList.add('active');
      overlay.classList.add('show');
      hamburgerText.textContent = 'Back';
      hamburger.querySelector('i').classList.replace('fa-bars', 'fa-arrow-left');
    }

    function closeSidebar() {
      sidebar.classList.remove('active');
      overlay.classList.remove('show');
      hamburgerText.textContent = 'Menu';
      hamburger.querySelector('i').classList.replace('fa-arrow-left', 'fa-bars');
    }

    hamburger.addEventListener('click', () => {
      sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
    });

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
  });
</script>

<style>
  .menu-section {
    font-weight: 700;
    font-size: 14px;
    color: #fff;
    margin-top: 1px;
    padding: 10px 20px 5px;
    letter-spacing: 1px;
  }

  .divider {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.2);
    margin: 10px 0;
  }

  .menu-item {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.2s;
  }

  .menu-item i {
    margin-right: 10px;
  }

  .menu-item:hover,
  .menu-item.active {
    background: rgba(255,255,255,0.1);
    border-radius: 6px;
  }

  .logout-form {
    margin-top: 20px;
    padding: 10px 20px;
  }

  .logout-btn {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px 15px;
    width: 100%;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .logout-btn:hover {
    opacity: 0.9;
  }
</style>
