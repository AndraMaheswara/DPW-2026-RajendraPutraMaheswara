<?php
require_once __DIR__ . '/../includes/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID pelanggan tidak valid.'
    ];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM pelanggan WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $_SESSION['flash'] = [
        'type' => $stmt->rowCount() > 0 ? 'success' : 'warning',
        'pesan' => $stmt->rowCount() > 0
            ? 'Pelanggan berhasil dihapus.'
            : 'Pelanggan tidak ditemukan.'
    ];
} catch (PDOException $e) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Pelanggan gagal dihapus. Data mungkin masih digunakan oleh data lain.'
    ];
}

header('Location: list.php');
exit;
