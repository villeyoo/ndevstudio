document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");

    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", function () {
            navLinks.classList.toggle("show");
        });
    }
});


window.addEventListener("scroll", function() {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 20) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

// === SCROLL TO TOP BUTTON ===
const scrollTopBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", function() {
  if (window.scrollY > 300) {
    scrollTopBtn.classList.add("show");
  } else {
    scrollTopBtn.classList.remove("show");
  }
});

scrollTopBtn.addEventListener("click", function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 20) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

(function(){
  // Ubah daftar frasa di sini
  const phrases = [
    "Beli",           // Indonesia
    "Tuku",           // Jawa
    "Meli",           // Bali
    "Meuli",          // Sunda"
  ];

  const el = document.getElementById('rotatingText');
  if(!el) return;

  // konfigurasi
  const holdTime = 2200;    // ms teks terlihat penuh sebelum diganti
  const fadeTime = 360;     // ms durasi fade out / in (sama dengan CSS transition)
  let idx = 0;

  // helper: set text while keeping aria-friendly attributes
  function setText(newText){
    // jika butuh markup (mis. highlight kata tertentu), kamu bisa parse HTML here
    el.textContent = newText;
  }

  // main loop
  setText(phrases[0]);
  el.classList.add('rotating-fade-in');

  function next(){
    // fade out
    el.classList.remove('rotating-fade-in');
    el.classList.add('rotating-fade-out');

    // setelah fadeTime, ganti teks dan fade in
    setTimeout(()=>{
      idx = (idx + 1) % phrases.length;
      setText(phrases[idx]);

      el.classList.remove('rotating-fade-out');
      el.classList.add('rotating-fade-in');
    }, fadeTime);

    // schedule next full cycle
    setTimeout(next, fadeTime + holdTime);
  }

  // start after initial holdTime
  setTimeout(next, holdTime);

  // Optional: pause on hover to let user read
  let paused = false;
  el.addEventListener('mouseenter', ()=>{ paused = true; });
  el.addEventListener('mouseleave', ()=>{ paused = false; });
  // If you want to actually stop/show pause behavior, you'd need to clear and restart timers.
})();

function formatNumber(value) {
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  // --- Input Jumlah Robux ---
  const titleInput = document.getElementById('title');
  titleInput.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // hapus non-digit
    if (value) {
      e.target.value = formatNumber(value) + ' ROBUX';
    } else {
      e.target.value = '';
    }
  });

  // --- Input Harga Robux ---
  const priceInput = document.getElementById('price');
  priceInput.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // hanya angka
    if (value) {
      e.target.value = 'Rp ' + formatNumber(value);
    } else {
      e.target.value = '';
    }
  });

  // --- Bersihkan format saat form disubmit (supaya data bersih di DB) ---
  const form = document.querySelector('form');
  form.addEventListener('submit', function() {
    titleInput.value = titleInput.value.replace(/\D/g, '');
    priceInput.value = priceInput.value.replace(/\D/g, '');
  });

 