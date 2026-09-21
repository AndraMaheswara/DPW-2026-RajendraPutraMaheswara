// =============================================================================
// SIMPUS-Mini — app.js (Jobsheet 5: Manipulasi DOM & Event)
// -----------------------------------------------------------------------------
// Catatan adaptasi: dokumentasi Jobsheet 5 aslinya menyambung dari Jobsheet 3
// versi CSS murni, sehingga punya fungsi initNavToggle() untuk menu hamburger
// (checkbox diganti <button id="nav-toggle-btn"> + classList.toggle).
// Karena proyek ini sudah memakai navbar Bootstrap (.navbar-toggler dengan
// data-bs-toggle="collapse"), buka/tutup menu hamburger SUDAH ditangani
// otomatis oleh bootstrap.bundle.min.js — jadi fungsi toggle manual itu
// TIDAK ditambahkan lagi di sini supaya tidak dobel/bertabrakan.
// Tiga fitur JS lain dari Jobsheet 5 (konfirmasi hapus, filter tabel
// real-time, validasi form) tetap murni JavaScript custom dan dipasang
// seperti biasa di bawah ini.
// =============================================================================

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
            }
        });
    });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Field wajib pertama: "Judul" (form Buku) atau "Nama" (form Anggota)
        const utama = form.querySelector("[name='judul'], [name='nama']");
        if (utama && utama.value.trim() === "") {
            tampilkanError(utama, "Field ini wajib diisi.");
            valid = false;
        } else if (utama) {
            hapusError(utama);
        }

        // Field wajib kedua: "Pengarang" (form Buku) atau "No. Anggota" (form Anggota)
        const kedua = form.querySelector("[name='pengarang'], [name='no_anggota']");
        if (kedua && kedua.value.trim() === "") {
            tampilkanError(kedua, "Field ini wajib diisi.");
            valid = false;
        } else if (kedua) {
            hapusError(kedua);
        }

        // "Tahun Terbit" — hanya ada di form Tambah Buku
        const tahun = form.querySelector("[name='tahun']");
        if (tahun) {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        // "Stok" — hanya ada di form Tambah Buku
        const stok = form.querySelector("[name='stok']");
        if (stok) {
            const nilai = parseInt(stok.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(stok, "Stok tidak boleh kosong atau negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});
