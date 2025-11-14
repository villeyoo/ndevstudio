// assets/js/main.js
// Versi lengkap: nav, scroll, rotating text, input formatting, reverse gamepass tax calculator, copy fallback
document.addEventListener("DOMContentLoaded", function () {
    // ---------- Helper ----------
    function $id(id) {
        return document.getElementById(id);
    }
    function q(sel) {
        return document.querySelector(sel);
    }

    // ---------- NAV TOGGLE ----------
    (function navToggle() {
        const menuToggle = $id("menu-toggle");
        const navLinks = $id("nav-links");
        if (!menuToggle || !navLinks) return;
        menuToggle.addEventListener("click", function () {
            navLinks.classList.toggle("show");
        });
    })();

    // ---------- NAVBAR SCROLL CLASS ----------
    (function navbarScroll() {
        const navbar = q(".navbar");
        if (!navbar) return;
        function handle() {
            if (window.scrollY > 20) navbar.classList.add("scrolled");
            else navbar.classList.remove("scrolled");
        }
        handle();
        window.addEventListener("scroll", handle);
    })();

    // ---------- SCROLL TO TOP BUTTON ----------
    (function scrollTop() {
        const scrollTopBtn = $id("scrollTopBtn");
        if (!scrollTopBtn) return;
        function update() {
            if (window.scrollY > 300) scrollTopBtn.classList.add("show");
            else scrollTopBtn.classList.remove("show");
        }
        update();
        window.addEventListener("scroll", update);
        scrollTopBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    })();

    // ---------- ROTATING TEXT ----------
    (function rotatingText() {
        const phrases = ["Beli", "Tuku", "Meli", "Meuli"];
        const el = $id("rotatingText");
        if (!el) return;
        const holdTime = 2200;
        const fadeTime = 360;
        let idx = 0;
        let timeoutId = null;

        function setText(t) {
            el.textContent = t;
        }

        setText(phrases[0]);
        el.classList.add("rotating-fade-in");

        function next() {
            el.classList.remove("rotating-fade-in");
            el.classList.add("rotating-fade-out");

            setTimeout(() => {
                idx = (idx + 1) % phrases.length;
                setText(phrases[idx]);
                el.classList.remove("rotating-fade-out");
                el.classList.add("rotating-fade-in");
            }, fadeTime);

            timeoutId = setTimeout(next, fadeTime + holdTime);
        }

        timeoutId = setTimeout(next, holdTime);

        el.addEventListener("mouseenter", () => {
            if (timeoutId) clearTimeout(timeoutId);
        });
        el.addEventListener("mouseleave", () => {
            timeoutId = setTimeout(next, holdTime);
        });
    })();

    // ---------- Format helpers ----------
    function formatNumber(n) {
        // support numbers or numeric strings
        const s = String(n);
        // If contains decimal, keep as is; otherwise integer formatting
        const parts = s.split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(".");
    }
    function cleanDigits(s) {
        return String(s || "").replace(/\D/g, "");
    }

    // ---------- INPUT JUMLAH ROBUX (title) ----------
    (function inputTitle() {
        const titleInput = $id("title");
        if (!titleInput) return;
        titleInput.addEventListener("input", function (e) {
            const value = cleanDigits(e.target.value);
            e.target.value = value ? formatNumber(value) + " ROBUX" : "";
        });
    })();

    // ---------- INPUT HARGA (price) ----------
    (function inputPrice() {
        const priceInput = $id("price");
        if (!priceInput) return;
        priceInput.addEventListener("input", function (e) {
            const value = cleanDigits(e.target.value);
            e.target.value = value ? "Rp " + formatNumber(value) : "";
        });
    })();

    // ---------- FORM SUBMIT CLEANUP ----------
    (function formCleanup() {
        const form = q("form");
        if (!form) return;
        const titleInput = $id("title");
        const priceInput = $id("price");
        form.addEventListener("submit", function () {
            if (titleInput) titleInput.value = cleanDigits(titleInput.value);
            if (priceInput) priceInput.value = cleanDigits(priceInput.value);
        });
    })();

    // ---------- CEK PAJAK GAMEPASS (reverse calc) ----------
    (function cekPajakReverse() {
        const gpNet = $id("gp-net");
        const gpCalc = $id("gp-calc");
        const gpReset = $id("gp-reset");
        const gpResult = $id("gp-result");
        const resGross = $id("res-gross");
        const resTax = $id("res-tax");
        const resNet = $id("res-net");
        const resCopy = $id("res-copy");

        // If essential elements missing, do nothing (safe)
        if (
            !gpNet ||
            !gpCalc ||
            !gpReset ||
            !gpResult ||
            !resGross ||
            !resTax ||
            !resNet
        ) {
            // still inject invalid-style if missing CSS
            injectInvalidStyle();
            return;
        }

        // Show / hide result UI
        function showResult(gross, tax, net) {
            resGross.textContent = `${formatNumber(gross)} Robux`;
            resTax.textContent = `- ${formatNumber(tax)} Robux`;
            resNet.textContent = `${formatNumber(net)} Robux`;

            gpResult.style.transition =
                "opacity .22s ease, transform .22s ease";
            gpResult.style.opacity = "1";
            gpResult.style.transform = "translateY(0)";
            gpResult.style.pointerEvents = "auto";

            if (resCopy) {
                resCopy.disabled = false;
                resCopy.classList.remove("disabled");
            }
        }

        function hideResult() {
            gpResult.style.opacity = "0";
            gpResult.style.transform = "translateY(8px)";
            gpResult.style.pointerEvents = "none";
            resGross.textContent = "—";
            resTax.textContent = "—";
            resNet.textContent = "—";

            if (resCopy) {
                resCopy.disabled = true;
                resCopy.classList.add("disabled");
            }
        }

        function calculateGrossForNet(targetNet) {
            const marketplaceRate = 0.3; // 30%
            if (!targetNet || targetNet <= 0) return null;
            // gross must be integer Robux; use ceil so net >= target
            const gross = Math.ceil(targetNet / (1 - marketplaceRate));
            const tax = Math.round(gross * marketplaceRate);
            const netReceived = gross - tax;
            return { gross, tax, netReceived };
        }

        // copy helper with fallback
        function writeToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                return navigator.clipboard.writeText(text);
            }
            return new Promise((resolve, reject) => {
                try {
                    const ta = document.createElement("textarea");
                    ta.value = text;
                    ta.setAttribute("readonly", "");
                    ta.style.position = "fixed";
                    ta.style.left = "-9999px";
                    document.body.appendChild(ta);
                    ta.select();
                    const ok = document.execCommand("copy");
                    document.body.removeChild(ta);
                    if (ok) resolve();
                    else reject(new Error("execCommand copy failed"));
                } catch (err) {
                    reject(err);
                }
            });
        }

        // calc handler
        gpCalc.addEventListener("click", function () {
            const target = Number(gpNet.value);
            if (!target || target <= 0) {
                gpNet.classList.add("invalid-pulse");
                setTimeout(() => gpNet.classList.remove("invalid-pulse"), 700);
                hideResult();
                return;
            }
            const res = calculateGrossForNet(target);
            if (!res) {
                hideResult();
                return;
            }
            showResult(res.gross, res.tax, res.netReceived);
        });

        // reset handler
        gpReset.addEventListener("click", function () {
            gpNet.value = "";
            hideResult();
        });

        // enter to calculate
        gpNet.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                gpCalc.click();
            }
        });

        // copy handler (if button present)
        if (resCopy) {
            resCopy.disabled = true;
            resCopy.classList.add("disabled");

            resCopy.addEventListener("click", function () {
                let text = resGross.textContent;
                if (!text || text === "—") return;

                // AMBIL ANGKA SAJA → "1.429 Robux" → "1429"
                const onlyNumber = text.replace(/[^\d]/g, "");

                writeToClipboard(onlyNumber)
                    .then(() => {
                        const original = resCopy.textContent;
                        resCopy.textContent = "Tersalin!";
                        resCopy.classList.add("copied");
                        setTimeout(() => {
                            resCopy.textContent = original;
                            resCopy.classList.remove("copied");
                        }, 1200);
                    })
                    .catch(() => {
                        // fallback prompt
                        window.prompt("Salin manual:", onlyNumber);
                    });
            });
        }

        // initial hide
        hideResult();
        // ensure invalid style exists
        injectInvalidStyle();
    })();

    // ---------- Small utility: inject invalid-pulse CSS if not present ----------
    function injectInvalidStyle() {
        const id = "cekpajak-invalid-style";
        if (document.getElementById(id)) return;
        const style = document.createElement("style");
        style.id = id;
        style.textContent = `
      .invalid-pulse { animation: invalidPulse .7s ease; border-color:#ff4d6d !important; box-shadow: 0 6px 20px rgba(255,77,109,0.08); }
      @keyframes invalidPulse { 0% { transform: translateY(0);} 50% { transform: translateY(-4px);} 100% { transform: translateY(0);} }
      .btn-small.disabled { opacity: 0.6; pointer-events: none; background: #9ca3af; }
      .btn-small.copied { background: #10b981; }
      .rotating-fade-in { opacity:1; transition:opacity .36s ease; }
      .rotating-fade-out { opacity:0; transition:opacity .36s ease; }
    `;
        document.head.appendChild(style);
    }
}); // DOMContentLoaded end
