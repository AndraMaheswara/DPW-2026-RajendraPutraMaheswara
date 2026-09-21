# TECHSTORE MINI — Jobsheet 7 — Vercel

Project ini menggunakan PHP + `$_SESSION` sesuai materi Jobsheet 7.
Tidak menggunakan Supabase atau database.

## Deploy ke Vercel

1. Upload/push isi folder ini ke GitHub.
2. Di Vercel buat project dari repository tersebut.
3. Karena `Dockerfile.vercel` berada di root project, Vercel dapat mendeteksi container.
4. Framework Preset: pilih `Container` jika opsi tersebut tersedia.
5. Root Directory: gunakan `.` (root repository).
6. Deploy.

Vercel menjalankan PHP melalui Apache di dalam container pada port 80.

## Catatan penting tentang $_SESSION

Session cocok untuk latihan Jobsheet 7, tetapi Vercel container bersifat stateless.
Data session tidak dijamin bertahan setelah instance di-restart, scale-to-zero, atau berpindah instance.

Artinya project ini cocok untuk demonstrasi Jobsheet 7, tetapi bukan penyimpanan data permanen.
Untuk data permanen/produksi, gunakan database seperti pada Jobsheet 8.
