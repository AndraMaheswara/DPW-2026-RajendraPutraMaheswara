<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = 'Registrasi';
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="content-card form-card auth-card">
    <div class="section-heading">
        <div><p class="eyebrow">AUTHENTICATION</p><h2>Registrasi Petugas</h2><p class="section-desc">Buat akun untuk mengelola data TECHSTORE MINI.</p></div>
    </div>
    <?php if ($flash): ?>
        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p>
    <?php endif; ?>
    <form method="post" action="proses_register.php">
        <div class="form-grid">
            <p class="full"><label for="nama">Nama</label><input type="text" id="nama" name="nama" required></p>
            <p class="full"><label for="username">Username</label><input type="text" id="username" name="username" required maxlength="50"></p>
            <p class="full"><label for="password">Password</label><input type="password" id="password" name="password" required minlength="6"></p>
        </div>
        <div class="form-actions"><button class="btn btn-primary" type="submit">Daftar</button></div>
    </form>
    <p class="auth-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
