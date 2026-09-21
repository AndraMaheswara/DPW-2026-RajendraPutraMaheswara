<?php
session_start();

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

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['pelanggan'])) $_SESSION['pelanggan'] = [];

$nextId = count($_SESSION['pelanggan']) + 1;
$_SESSION['pelanggan'][] = [
    'id' => 'PLG-' . str_pad((string)$nextId, 3, '0', STR_PAD_LEFT),
    'nama' => $nama,
    'email' => $email,
    'no_hp' => $noHp,
    'alamat' => $alamat
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil ditambahkan.'];
header('Location: list.php');
exit;
