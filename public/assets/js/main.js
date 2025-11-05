/*
  main.js — Toggle sidebar & mobile nav, overlay, accessibility
  - Requires elements: .overlay, .sidebar, .hamburger, .menu-toggle, .nav-links, .close-btn (optional), #scrollTopBtn (optional)
  - Keeps overlay under menus and allows clicking menu items
*/

document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;
  const overlay = document.querySelector('.overlay');
  const sidebar = document.querySelector('.sidebar');
  const hamburger = document.querySelector('.hamburger');       // toggle sidebar
  const closeBtn = document.querySelector('.close-btn');        // optional inside sidebar
  const menuToggle = document.querySelector('.menu-toggle');    // toggle fullscreen nav
  const navLinks = document.querySelector('.nav-links');        // fullscreen nav container
  const navbar = document.querySelector('.navbar');
  const scrollTopBtn = document.getElementById('scrollTopBtn');

  // utility checks
  const hasSidebar = !!sidebar;
  const hasNavLinks = !!navLinks;

  function openSidebar() {
    if (!hasSidebar) return;
    sidebar.classList.add('active');
    overlay.classList.add('show');
    body.classList.add('sidebar-open');
    // ensure overlay sits below sidebar via CSS z-index
  }
  function closeSidebar() {
    if (!hasSidebar) return;
    sidebar.classList.remove('active');
    overlay.classList.remove('show');
    body.classList.remove('sidebar-open');
  }
  function openNavMenu() {
    if (!hasNavLinks) return;
    navLinks.classList.add('show');
    overlay.classList.add('show');
    body.classList.add('sidebar-open');
    // ensure navLinks is above overlay via CSS z-index
  }
  function closeNavMenu() {
    if (!hasNavLinks) return;
    navLinks.classList.remove('show');
    overlay.classList.remove('show');
    body.classList.remove('sidebar-open');
  }
  function closeAll() {
    closeSidebar();
    closeNavMenu();
  }

  // hamburger toggles sidebar
  if (hamburger) {
    hamburger.addEventListener('click', function (e) {
      e.stopPropagation();
      if (sidebar.classList.contains('active')) closeSidebar();
      else openSidebar();
    });
  }

  // optional close button inside sidebar
  if (closeBtn) {
    closeBtn.addEventListener('click', function (e) {
      e.preventDefault();
      closeSidebar();
    });
  }

  // menuToggle toggles fullscreen navLinks
  if (menuToggle) {
    menuToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      if (navLinks.classList.contains('show')) closeNavMenu();
      else openNavMenu();
    });
  }

  // clicking overlay closes whatever open
  if (overlay) {
    overlay.addEventListener('click', function () {
      closeAll();
    });
  }

  // close on escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' || e.key === 'Esc') closeAll();
  });

  // close mobile nav when clicking a link inside it
  if (hasNavLinks) {
    navLinks.addEventListener('click', function (e) {
      const a = e.target.closest('a,button');
      if (a) {
        // allow default navigation, then close
        setTimeout(closeNavMenu, 60);
      }
    });
  }

  // if sidebar links (mobile) clicked, close sidebar
  if (hasSidebar) {
    sidebar.addEventListener('click', function (e) {
      const a = e.target.closest('a,button');
      if (a && !a.classList.contains('no-close')) {
        setTimeout(closeSidebar, 80);
      }
    });
  }

  // ensure nav-links children are clickable (safety)
  if (hasNavLinks) navLinks.style.pointerEvents = 'auto';
  if (hasSidebar) sidebar.style.pointerEvents = 'auto';

  // navbar scrolled
  (function () {
    if (!navbar) return;
    let ticking = false;
    const threshold = 12;
    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(function () {
          const y = window.scrollY || window.pageYOffset;
          if (y > threshold) navbar.classList.add('scrolled'); else navbar.classList.remove('scrolled');
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  })();

  // scroll to top button handling
  (function () {
    if (!scrollTopBtn) return;
    const showAt = 240;
    window.addEventListener('scroll', function () {
      if ((window.scrollY || window.pageYOffset) > showAt) scrollTopBtn.classList.add('show');
      else scrollTopBtn.classList.remove('show');
    }, { passive: true });
    scrollTopBtn.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
  })();

  // resize: close mobile menus when switching to desktop
  let resizeTimer = null;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      if (window.innerWidth > 992) {
        closeAll();
        if (sidebar) sidebar.classList.remove('active');
      }
    }, 120);
  });

  // click outside behavior: close if clicked outside open menu(s)
  document.addEventListener('click', function (e) {
    const insideSidebar = hasSidebar && sidebar.contains(e.target);
    const insideNav = hasNavLinks && navLinks.contains(e.target);
    const clickedHamburger = hamburger && hamburger.contains(e.target);
    const clickedMenuToggle = menuToggle && menuToggle.contains(e.target);

    if (hasSidebar && sidebar.classList.contains('active') && !insideSidebar && !clickedHamburger) closeSidebar();
    if (hasNavLinks && navLinks.classList.contains('show') && !insideNav && !clickedMenuToggle) closeNavMenu();
  }, true);

  // basic focus trap for navLinks (so Tab stays inside menu)
  (function () {
    if (!hasNavLinks) return;
    let first, last;
    function updateFocusable() {
      const nodes = navLinks.querySelectorAll('a,button,[tabindex]:not([tabindex="-1"])');
      if (nodes.length) { first = nodes[0]; last = nodes[nodes.length - 1]; }
      else first = last = null;
    }
    document.addEventListener('keydown', function (e) {
      if (!navLinks.classList.contains('show')) return;
      if (e.key === 'Tab') {
        updateFocusable();
        if (!first || !last) { e.preventDefault(); return; }
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });
  })();

}); // DOMContentLoaded
