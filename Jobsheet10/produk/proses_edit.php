<?php
require __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$kode = strtoupper(trim($_POST['kode'] ?? ''));
$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$kategoriValid = ['Processor','VGA','RAM','Storage','Motherboard','PSU','Casing','Monitor','Keyboard','Mouse','Headset'];
$errors = [];

if (!$id) $errors[] = 'ID produk tidak valid.';
if ($kode === '') $errors[] = 'Kode produk wajib diisi.';
if ($nama === '') $errors[] = 'Nama produk wajib diisi.';
if (!in_array($kategori, $kategoriValid, true)) $errors[] = 'Kategori produk tidak valid.';
if ($harga === '' || !is_numeric($harga) || (float)$harga <= 0) $errors[] = 'Harga harus berupa angka dan lebih besar dari 0.';
if ($stok === '' || filter_var($stok, FILTER_VALIDATE_INT) === false || (int)$stok < 0) $errors[] = 'Stok harus berupa angka bulat dan tidak boleh negatif.';

if (!$errors) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE LOWER(kode) = LOWER(:kode) AND id <> :id");
    $stmt->execute([':kode' => $kode, ':id' => $id]);
    if ((int)$stmt->fetchColumn() > 0) $errors[] = 'Kode produk sudah digunakan oleh produk lain.';
}

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode((string)$id));
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE produk SET kode = :kode, nama = :nama, kategori = :kategori, harga = :harga, stok = :stok WHERE id = :id");
    $stmt->execute([':kode' => $kode, ':nama' => $nama, ':kategori' => $kategori, ':harga' => $harga, ':stok' => (int)$stok, ':id' => $id]);
    $_SESSION['flash'] = ['type' => $stmt->rowCount() > 0 ? 'success' : 'warning', 'pesan' => $stmt->rowCount() > 0 ? 'Produk berhasil diperbarui.' : 'Tidak ada perubahan pada data produk.'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui produk. Kode mungkin sudah digunakan.'];
    header('Location: edit.php?id=' . urlencode((string)$id));
    exit;
}

header('Location: list.php');
exit;
