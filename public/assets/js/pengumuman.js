document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("claimForm");
  const input = document.getElementById("claimCode");
  const resultBox = document.getElementById("claimResult");

  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const code = input.value.trim().toUpperCase();
    let statusHTML = "";

    const claimCodes = {
      "J1RVNDSA": {
        status: "not_processed",
        message: "❕ Klaim kamu sudah tercatat, namun BELUM diproses oleh admin, cek kembali nanti"
      },
      "J2DNODSA": {
        status: "procenot_processedss",
        message: "❕ Klaim kamu sudah tercatat, namun BELUM diproses oleh admin, cek kembali nanti"
      },
      "J3MYMDSA": {
        status: "not_processed",
        message: "❕ Klaim kamu sudah tercatat, namun BELUM diproses oleh admin, cek kembali nanti"
      },
      "J4PYIDSA": {
        status: "not_processed",
        message: "❕ Klaim kamu sudah tercatat, namun BELUM diproses oleh admin, cek kembali nanti"
      }
    };

    let color = "#9ca3af"; // default: belum diproses

    if (claimCodes[code]) {
      const data = claimCodes[code];

      if (data.status === "not_processed") color = "#9ca3af";
      if (data.status === "pending") color = "#facc15";
      if (data.status === "process") color = "#3b82f6";
      if (data.status === "success") color = "#22c55e";
      if (data.status === "rejected") color = "#ef4444";

      statusHTML = `
        <div class="claim-status" style="background:${color}">
          ${data.message}
        </div>
      `;
    } else {
      statusHTML = `
        <div class="claim-status error">
          ❌ Kode klaim tidak ditemukan atau tidak valid.
        </div>
      `;
    }

    resultBox.innerHTML = statusHTML;
    resultBox.style.display = "block";
  });
});
