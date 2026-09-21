// Mengambil & menampilkan Daftar Buku secara asinkron dari data/buku.json
async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // Simulasi delay jaringan sesuai latihan Jobsheet 06.
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/buku.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }

        const daftarBuku = await res.json();

        if (!Array.isArray(daftarBuku)) {
            throw new Error("Format data buku.json tidak valid");
        }

        if (daftarBuku.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5">Belum ada data buku.</td></tr>';
            return;
        }

        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            tr.dataset.name = buku.judul ?? "Buku tanpa judul";

            const judul = document.createElement("td");
            judul.textContent = buku.judul ?? "-";

            const pengarang = document.createElement("td");
            pengarang.textContent = buku.pengarang ?? "-";

            const tahun = document.createElement("td");
            tahun.textContent = buku.tahun ?? "-";

            const stok = document.createElement("td");
            stok.textContent = buku.stok ?? "0";

            const aksi = document.createElement("td");
            const editBtn = document.createElement("button");
            editBtn.type = "button";
            editBtn.textContent = "Edit";

            const hapusBtn = document.createElement("button");
            hapusBtn.type = "button";
            hapusBtn.className = "btn-hapus";
            hapusBtn.textContent = "Hapus";

            aksi.append(editBtn, document.createTextNode(" "), hapusBtn);
            tr.append(judul, pengarang, tahun, stok, aksi);
            tbody.appendChild(tr);
        });
    } catch (err) {
        const message = err instanceof Error ? err.message : String(err);
        tbody.innerHTML =
            '<tr><td colspan="5">Gagal memuat data: ' + message.replace(/[<>]/g, "") + "</td></tr>";
    } finally {
        if (loading) loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBuku);
