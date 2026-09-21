// Mengambil & menampilkan Daftar Anggota secara asinkron dari data/anggota.json
async function muatDaftarAnggota() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/anggota.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }

        const daftarAnggota = await res.json();

        if (!Array.isArray(daftarAnggota)) {
            throw new Error("Format data anggota.json tidak valid");
        }

        if (daftarAnggota.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5">Belum ada data anggota.</td></tr>';
            return;
        }

        daftarAnggota.forEach(function (anggota) {
            const tr = document.createElement("tr");
            tr.dataset.name = anggota.nama ?? "Anggota tanpa nama";

            const noAnggota = document.createElement("td");
            noAnggota.textContent = anggota.no_anggota ?? "-";

            const nama = document.createElement("td");
            nama.textContent = anggota.nama ?? "-";

            const alamat = document.createElement("td");
            alamat.textContent = anggota.alamat ?? "-";

            const noHp = document.createElement("td");
            noHp.textContent = anggota.no_hp ?? "-";

            const aksi = document.createElement("td");
            const editBtn = document.createElement("button");
            editBtn.type = "button";
            editBtn.textContent = "Edit";

            const hapusBtn = document.createElement("button");
            hapusBtn.type = "button";
            hapusBtn.className = "btn-hapus";
            hapusBtn.textContent = "Hapus";

            aksi.append(editBtn, document.createTextNode(" "), hapusBtn);
            tr.append(noAnggota, nama, alamat, noHp, aksi);
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

document.addEventListener("DOMContentLoaded", muatDaftarAnggota);
