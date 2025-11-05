<!-- Tombol Hamburger / Back -->
<button class="hamburger" id="hamburgerBtn">
  <i class="fa-solid fa-bars"></i>
  <span id="hamburgerText">Menu</span>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h3 class="logo">Ndev Studio</h3>
    <button class="close-btn" id="closeSidebar">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <ul class="menu">
    <li><a href="{{ route('dashboard') }}" class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <i class="fa-solid fa-house"></i>
      <span>Dashboard</span>
    </a></li>

    <li><a href="{{ route('lowongan.create') }}" class="menu-item">
      <i class="fa-solid fa-plus"></i>
      <span>Tambah Lowongan</span>
    </a></li>

    <li><a href="{{ route('bug.index') }}" class="menu-item">
      <i class="fa-solid fa-bug"></i>
      <span>Tambah Bug</span>
    </a></li>

    <li><a href="{{ route('robux.index') }}" class="menu-item">
      <i class="fa-solid fa-coins"></i>
      <span>Permintaan Robux</span>
    </a></li>

    <li><a href="{{ route('lowongan.list') }}" class="menu-item">
      <i class="fa-solid fa-list"></i>
      <span>List Lowongan</span>
    </a></li>

    <li><a href="{{ route('scripter.index') }}" class="menu-item">
      <i class="fa-solid fa-code"></i>
      <span>Scripter</span>
    </a></li>

    <li><a href="{{ route('polisi.index') }}" class="menu-item">
      <i class="fa-solid fa-shield-halved"></i>
      <span>Polisi</span>
    </a></li>

    <li><a href="{{ route('content-creator.index') }}" class="menu-item">
      <i class="fa-solid fa-user-pen"></i>
      <span>Content Creator</span>
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

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a2e0e6b9d4.js" crossorigin="anonymous"></script>

<!-- Sidebar Toggle Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const hamburger = document.getElementById('hamburgerBtn');
  const hamburgerText = document.getElementById('hamburgerText');
  const closeBtn = document.getElementById('closeSidebar');
  const menuLinks = document.querySelectorAll('.menu-item');

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

  // Toggle Sidebar
  hamburger.addEventListener('click', () => {
    if (sidebar.classList.contains('active')) {
      closeSidebar();
    } else {
      openSidebar();
    }
  });

  // Tombol close (di sidebar)
  closeBtn.addEventListener('click', closeSidebar);

  // Klik overlay nutup
  overlay.addEventListener('click', closeSidebar);

  // Klik menu nutup sidebar di mobile
  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 768) closeSidebar();
    });
  });
});
</script>
