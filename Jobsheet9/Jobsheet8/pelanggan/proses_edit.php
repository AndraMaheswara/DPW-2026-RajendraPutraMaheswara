<?php
session_start();
require_once __DIR__ . '/../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$errors = [];

if (!$id) $errors[] = 'ID pelanggan tidak valid.';
if ($nama === '') $errors[] = 'Nama wajib diisi.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email wajib diisi dan harus memiliki format yang valid.';
if ($noHp === '') $errors[] = 'Nomor HP wajib diisi.';
if ($alamat === '') $errors[] = 'Alamat wajib diisi.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode((string)$id));
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE pelanggan SET nama = :nama, email = :email, no_hp = :no_hp, alamat = :alamat WHERE id = :id");
    $stmt->execute([':nama' => $nama, ':email' => $email, ':no_hp' => $noHp, ':alamat' => $alamat, ':id' => $id]);
    $_SESSION['flash'] = ['type' => $stmt->rowCount() > 0 ? 'success' : 'warning', 'pesan' => $stmt->rowCount() > 0 ? 'Pelanggan berhasil diperbarui.' : 'Tidak ada perubahan pada data pelanggan.'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui pelanggan.'];
    header('Location: edit.php?id=' . urlencode((string)$id));
    exit;
}

header('Location: list.php');
exit;
