<?php
session_start();
require_once __DIR__ . '/../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$kode = strtoupper(trim($_POST['kode'] ?? ''));
$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';

$kategoriValid = ['Processor','VGA','RAM','Storage','Motherboard','PSU','Casing','Monitor','Keyboard','Mouse','Headset'];
$errors = [];

if ($kode === '') $errors[] = 'Kode produk wajib diisi.';
if ($nama === '') $errors[] = 'Nama produk wajib diisi.';
if (!in_array($kategori, $kategoriValid, true)) $errors[] = 'Kategori produk tidak valid.';
if ($harga === '' || !is_numeric($harga) || (float)$harga <= 0) $errors[] = 'Harga harus berupa angka dan lebih besar dari 0.';
if ($stok === '' || filter_var($stok, FILTER_VALIDATE_INT) === false || (int)$stok < 0) $errors[] = 'Stok harus berupa angka bulat dan tidak boleh negatif.';

if (!$errors) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE LOWER(kode) = LOWER(:kode)");
    $stmt->execute([':kode' => $kode]);
    if ((int)$stmt->fetchColumn() > 0) {
        $errors[] = 'Kode produk sudah digunakan.';
    }
}

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO produk (kode, nama, kategori, harga, stok)
         VALUES (:kode, :nama, :kategori, :harga, :stok)"
    );
    $stmt->execute([
        ':kode' => $kode,
        ':nama' => $nama,
        ':kategori' => $kategori,
        ':harga' => $harga,
        ':stok' => (int)$stok,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Produk berhasil ditambahkan.'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan produk ke database.'];
}

header('Location: list.php');
exit;
