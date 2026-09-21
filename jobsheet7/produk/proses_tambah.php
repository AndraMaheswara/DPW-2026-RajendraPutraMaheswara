<?php
session_start();

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

$daftarProduk = $_SESSION['produk'] ?? [];
foreach ($daftarProduk as $produk) {
    if (strcasecmp($produk['kode'], $kode) === 0) {
        $errors[] = 'Kode produk sudah digunakan.';
        break;
    }
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['produk'])) $_SESSION['produk'] = [];

$_SESSION['produk'][] = [
    'kode' => $kode,
    'nama' => $nama,
    'kategori' => $kategori,
    'harga' => (int)$harga,
    'stok' => (int)$stok
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Produk berhasil ditambahkan.'];
header('Location: list.php');
exit;
