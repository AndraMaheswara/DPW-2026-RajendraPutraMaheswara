# Patch — Hapus Pelanggan & Produk

Perubahan:
- Menambahkan tombol **Hapus** pada daftar pelanggan.
- Menambahkan tombol **Hapus** pada daftar produk.
- Konfirmasi browser sebelum penghapusan.
- Penghapusan dilakukan dengan `POST`, bukan `GET`.
- Menggunakan PDO prepared statement untuk `DELETE`.
- Menampilkan flash message setelah berhasil/gagal.
- Menambahkan `id` pada query daftar produk agar tombol hapus mengetahui record yang dipilih.
- Menambahkan styling tombol hapus agar konsisten dengan tema TECHSTORE MINI.
