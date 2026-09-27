<?php
$page_title = "Beranda";
require_once __DIR__ . '/includes/database.php';
include __DIR__ . '/includes/header.php';

$totalPelanggan = (int) $pdo->query("SELECT COUNT(*) FROM pelanggan")->fetchColumn();
$totalProduk = (int) $pdo->query("SELECT COUNT(*) FROM produk")->fetchColumn();
$produkTersedia = (int) $pdo->query("SELECT COUNT(*) FROM produk WHERE stok > 0")->fetchColumn();
$stokMenipis = (int) $pdo->query("SELECT COUNT(*) FROM produk WHERE stok BETWEEN 1 AND 5")->fetchColumn();
?>
<section class="hero-card">
    <div class="hero-copy">
        <p class="eyebrow">COMPUTER &amp; PERIPHERALS</p>
        <h1>TECHSTORE <span>MINI</span></h1>
        <p class="lead">Kelola pelanggan dan katalog komponen komputer dengan sederhana, rapi, dan cepat.</p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="pelanggan/list.php">Kelola Pelanggan</a>
            <a class="btn btn-secondary" href="produk/list.php">Kelola Produk</a>
        </div>
    </div>
    <div class="hero-decor" aria-hidden="true">
        <div class="orb"></div><div class="spark">✦</div><div class="flower">❀</div>
    </div>
</section>

<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">OVERVIEW</p><h2>Ringkasan Toko</h2></div>
        <span class="soft-label">Supabase PostgreSQL</span>
    </div>
    <div class="stats-grid">
        <article class="stat-card"><span class="stat-icon">♙</span><h3>Total Pelanggan</h3><p><?= $totalPelanggan ?></p></article>
        <article class="stat-card"><span class="stat-icon">▣</span><h3>Total Produk</h3><p><?= $totalProduk ?></p></article>
        <article class="stat-card"><span class="stat-icon">✓</span><h3>Produk Tersedia</h3><p><?= $produkTersedia ?></p></article>
        <article class="stat-card"><span class="stat-icon">!</span><h3>Stok Menipis</h3><p><?= $stokMenipis ?></p></article>
    </div>
</section>

<section class="content-card welcome-note">
    <p class="eyebrow">DATABASE</p>
    <h2>Data tersimpan di PostgreSQL.</h2>
    <p>TECHSTORE MINI menggunakan PDO untuk terhubung ke Supabase PostgreSQL.</p>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
