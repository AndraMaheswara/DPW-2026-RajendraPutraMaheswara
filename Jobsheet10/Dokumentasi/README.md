# Jobsheet 10 — Autentikasi & Manajemen Sesi TECHSTORE MINI

Jobsheet 10 merupakan lanjutan dari Jobsheet 09 dengan menambahkan autentikasi petugas dan manajemen session.

## Fitur
- Registrasi petugas dengan `password_hash()`.
- Login dengan `password_verify()`.
- Logout dan penghancuran session.
- Guard `includes/auth.php` untuk halaman yang membutuhkan login.
- Navbar dinamis: menampilkan Login untuk tamu dan nama petugas + Logout untuk pengguna yang sudah login.
- CRUD pelanggan tetap dilindungi login.
- CRUD produk (tambah/edit/hapus) dilindungi login, sedangkan daftar produk tetap dapat dilihat sebagai katalog publik.
- Search dan pagination Jobsheet 09 tetap dipertahankan.

## Database
Jalankan bagian tabel `users` pada `supabase-schema.sql` di database Supabase yang sama dengan Jobsheet 09.

```sql
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);
```

## Alur uji
1. Buka `auth/register.php` dan buat akun.
2. Login melalui `auth/login.php`.
3. Setelah login, navbar menampilkan nama petugas dan Logout.
4. Coba akses `pelanggan/list.php` atau form CRUD produk tanpa login: diarahkan ke Login.
5. `produk/list.php` tetap dapat dilihat tanpa login.
6. Logout lalu coba buka halaman yang dilindungi kembali.
