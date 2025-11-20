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
    const phrases = [
        "Selamat Datang",
        "Sugeng Rawuh",
        "Wilujeng Sumping",
        "Sampurasun",
        "Rahajeng Rauh",
        "Salam Satebben",
        "Horas!",
        "Tabea",
        "Salam Minang",
        "Welcome",
        "Bienvenido",
        "Benvenuto",
        "Selamat Dateng Rek",
        "Sugeng Rawuh Riko",
        "Sampurasun Baraya",
    ];

    const el = document.getElementById('rotatingText');
    if(!el) return;

    const holdTime = 2200;
    const fadeTime = 360;
    let idx = 0;

    function setText(newText){
        el.textContent = newText;
    }

    setText(phrases[0]);
    el.classList.add('rotating-fade-in');

    function next(){
        el.classList.remove('rotating-fade-in');
        el.classList.add('rotating-fade-out');

        setTimeout(()=>{
            idx = (idx + 1) % phrases.length;
            setText(phrases[idx]);

            el.classList.remove('rotating-fade-out');
            el.classList.add('rotating-fade-in');
        }, fadeTime);

        setTimeout(next, fadeTime + holdTime);
    }

    setTimeout(next, holdTime);

    let paused = false;
    el.addEventListener('mouseenter', ()=>{ paused = true; });
    el.addEventListener('mouseleave', ()=>{ paused = false; });
})();


// =====================================
//          IMAGE POPUP FULLSCREEN
// =====================================

const modal = document.getElementById("imgModal");
const modalImg = document.getElementById("imgPreview");
const closeModal = document.querySelector(".close-modal");

// Ambil semua gambar bukti
document.querySelectorAll(".evidence-image img").forEach(img => {
    img.addEventListener("click", () => {
        modal.style.display = "block";
        modalImg.src = img.src;
    });
});

// Tombol tutup
closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

// Klik area hitam juga tutup
modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
});
