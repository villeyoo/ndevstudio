<!-- Tombol Menu / Back (kanan atas) -->
<button class="hamburger" id="hamburgerBtn">
  <i class="fa-solid fa-bars"></i>
  <span id="hamburgerText">Menu</span>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
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
    if (sidebar.classList.contains('active')) closeSidebar();
    else openSidebar();
  });

  overlay.addEventListener('click', closeSidebar);
});
</script>
