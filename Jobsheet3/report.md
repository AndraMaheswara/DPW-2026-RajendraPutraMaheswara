|  | Desain Pemrograman Web|
|--|--|
| NIM |  254107020090|
| Nama |  Rajendra Putra Maheswara |
| Kelas | TI - 2D |
| Jobsheet | Jobsheet03 |

## Struktur File
```
jobsheet-03/
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
|      └── css/
|            └── style.css
├── buku/
│   ├── list.html
│   └── tambah.html
├── README.md
└── index.html
```

## Ringkasan
Jobsheet 03 berfokus pada penerapan desain responsif (responsive design) agar lima halaman web yang telah dibuat dan diberi styling pada Jobsheet 02 dapat menyesuaikan tampilannya di berbagai ukuran layar, mulai dari desktop, tablet, hingga mobile.
Perubahan yang dilakukan meliputi penambahan `<meta name="viewport">` di semua halaman, pembuatan menu hamburger murni CSS menggunakan teknik checkbox hack (`input[type=checkbox] + label`), pembungkus tabel `<div class="table-responsive">` agar dapat di-scroll horizontal di layar sempit, serta penerapan media query dengan breakpoint 768px (tablet) dan 480px (mobile) yang mengubah grid kartu statistik dari 3 → 2 → 1 kolom dan menyusun ulang navbar.
Praktikum ini memberikan pemahaman praktis mengenai konsep desain responsif desktop-first, penggunaan pseudo-class `:checked` dan sibling combinator (`~`) di CSS untuk membuat interaksi tanpa JavaScript, serta cara menangani elemen lebar seperti tabel di layar sempit agar tetap nyaman dibaca dan digunakan (user-friendly).
