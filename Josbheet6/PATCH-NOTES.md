# Patch Jobsheet 06

Patch ini dibuat agar dapat diterapkan ke proyek Jobsheet 05 yang memakai nama:
- `buku/list_buku.html`
- `buku/tambah_buku.html`
- `anggota/list_anggota.html`
- `anggota/tambah_anggota.html`

File yang perlu ditambahkan/ditimpa:
- `assets/js/app.js`
- `assets/js/buku.js`
- `assets/js/anggota.js`
- `data/buku.json`
- `data/anggota.json`
- `buku/list_buku.html`
- `anggota/list_anggota.html`

`assets/css/style.css`, halaman tambah, `index.html`, dan `docs/wireframe.md` tidak perlu diganti untuk inti Jobsheet 06.

Penting:
Jalankan proyek melalui server lokal, jangan membuka `list_buku.html` langsung dengan `file://`, karena `fetch()` ke file JSON dapat diblokir browser.
