<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = 'Login';
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="content-card form-card auth-card">
    <div class="section-heading">
        <div><p class="eyebrow">AUTHENTICATION</p><h2>Login Petugas</h2><p class="section-desc">Masuk untuk mengelola data TECHSTORE MINI.</p></div>
    </div>
    <?php if ($flash): ?>
        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p>
    <?php endif; ?>
    <form method="post" action="proses_login.php">
        <div class="form-grid">
            <p class="full"><label for="username">Username</label><input type="text" id="username" name="username" required autofocus></p>
            <p class="full"><label for="password">Password</label><input type="password" id="password" name="password" required></p>
        </div>
        <div class="form-actions"><button class="btn btn-primary" type="submit">Login</button></div>
    </form>
    <p class="auth-link">Belum punya akun? <a href="register.php">Daftar sebagai petugas</a></p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
