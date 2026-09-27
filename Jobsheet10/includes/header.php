<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sudahLogin = isset($_SESSION['user_id']);

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TECHSTORE MINI<?php echo isset($page_title) ? ' | ' . htmlspecialchars($page_title) : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="<?php echo $base; ?>index.php">
            <span class="brand-mark">✦</span>
            <span>TECHSTORE <em>MINI</em></span>
        </a>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Buka menu" aria-expanded="false">☰</button>
        <nav>
            <ul>
                <li><a class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li><a class="<?php echo strpos($_SERVER['PHP_SELF'], '/produk/') !== false ? 'active' : ''; ?>" href="<?php echo $base; ?>produk/list.php">Produk</a></li>
                <?php if ($sudahLogin): ?>
                    <li><a class="<?php echo strpos($_SERVER['PHP_SELF'], '/pelanggan/') !== false ? 'active' : ''; ?>" href="<?php echo $base; ?>pelanggan/list.php">Pelanggan</a></li>
<?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span><?= htmlspecialchars($_SESSION['nama'] ?? 'Petugas') ?></span>
                <a href="<?= $base ?>auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="<?= $base ?>auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<main class="page-shell">
