<?php
session_start();
require_once __DIR__ . '/../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$errors = [];

if ($nama === '') $errors[] = 'Nama wajib diisi.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email wajib diisi dan harus memiliki format yang valid.';
if ($noHp === '') $errors[] = 'Nomor HP wajib diisi.';
if ($alamat === '') $errors[] = 'Alamat wajib diisi.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $next = (int) $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 FROM pelanggan")->fetchColumn();
    $kode = 'PLG-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);

    $stmt = $pdo->prepare(
        "INSERT INTO pelanggan (kode, nama, email, no_hp, alamat)
         VALUES (:kode, :nama, :email, :no_hp, :alamat)"
    );
    $stmt->execute([
        ':kode' => $kode,
        ':nama' => $nama,
        ':email' => $email,
        ':no_hp' => $noHp,
        ':alamat' => $alamat,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil ditambahkan.'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan pelanggan ke database.'];
}

header('Location: list.php');
exit;
