<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';

$pelanggan = $_SESSION['pelanggan'] ?? [];
$produk = $_SESSION['produk'] ?? [];
$totalPelanggan = count($pelanggan);
$totalProduk = count($produk);
$produkTersedia = count(array_filter($produk, fn($p) => (int)$p['stok'] > 0));
$stokMenipis = count(array_filter($produk, fn($p) => (int)$p['stok'] >= 1 && (int)$p['stok'] <= 5));
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
        <span class="soft-label">Session data</span>
    </div>
    <div class="stats-grid">
        <article class="stat-card"><span class="stat-icon">♙</span><h3>Total Pelanggan</h3><p><?php echo $totalPelanggan; ?></p></article>
        <article class="stat-card"><span class="stat-icon">▣</span><h3>Total Produk</h3><p><?php echo $totalProduk; ?></p></article>
        <article class="stat-card"><span class="stat-icon">✓</span><h3>Produk Tersedia</h3><p><?php echo $produkTersedia; ?></p></article>
        <article class="stat-card"><span class="stat-icon">!</span><h3>Stok Menipis</h3><p><?php echo $stokMenipis; ?></p></article>
    </div>
</section>

<section class="content-card welcome-note">
    <p class="eyebrow">CATATAN</p>
    <h2>Tetap sederhana, tetap terorganisir.</h2>
    <p>Data latihan disimpan menggunakan <code>$_SESSION</code> sesuai materi Jobsheet 7. Belum menggunakan database.</p>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
