|  | Desain Pemrograman Web|
|--|--|
| NIM |  254107020090|
| Nama |  Rajendra Putra Maheswara |
| Kelas | TI - 2D |
| Jobsheet | Jobsheet03 (Bootstrap) + Jobsheet05 (JavaScript) |

## Struktur File
```
simpus-mini/
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── buku/
│   ├── list.html
│   └── tambah.html
├── docs/
│   └── wireframe.md
├── report.md
└── index.html
```

## Ringkasan

**Jobsheet 3 (Bootstrap):** Seluruh halaman (Beranda, Daftar/Tambah Buku,
Daftar/Tambah Anggota) dibangun ulang memakai Bootstrap 5.3.3 lewat CDN.
Header checkbox-hack diganti komponen `.navbar` + `.navbar-toggler`
(`data-bs-toggle="collapse"`), kartu statistik memakai grid `.row`/`.col-*`
+ `.card`, tabel memakai `.table-striped`/`.table-hover`, dan form memakai
`.form-control`/`.form-select`. Warna brand pink SIMPUS-Mini
(`#d96b8a`/`#c45b7c`/`#f05858`) tetap dipertahankan lewat atribut `style`
manual dan sedikit override di `style.css`, karena bukan bagian dari tema
warna bawaan Bootstrap. `style.css` menyusut dari ~245 baris menjadi hanya
berisi identitas brand + override navbar/tombol.

**Jobsheet 5 (JavaScript & DOM):** Ditambahkan `assets/js/app.js` dengan
tiga fitur interaktif front-end (belum terhubung ke server):
- **Konfirmasi hapus** — tombol "Hapus" di setiap tabel (`class="btn-hapus"`)
  menampilkan dialog `confirm()` sebelum menghapus baris dari tampilan.
- **Filter tabel real-time** — kotak pencarian baru di atas tabel Daftar
  Buku/Anggota menyaring baris sambil mengetik (event `keyup`).
- **Validasi form** — form Tambah Buku/Anggota (`id="form-tambah"`)
  diperiksa saat `submit`; field kosong atau tahun/stok tidak valid
  menampilkan pesan error merah di bawah field terkait.

Catatan: menu hamburger **tidak** diberi fungsi `initNavToggle` manual
seperti di dokumentasi Jobsheet 5 asli, karena buka/tutup navbar sudah
ditangani otomatis oleh `bootstrap.bundle.min.js` bawaan Bootstrap
(komponen `.navbar-toggler` + `.collapse`) — menambah fungsi toggle
manual di atasnya hanya akan dobel dan tidak diperlukan.
