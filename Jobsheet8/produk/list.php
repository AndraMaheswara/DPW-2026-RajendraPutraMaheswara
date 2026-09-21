<?php
$page_title = "Produk";
require_once __DIR__ . '/../includes/database.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$stmt = $pdo->query("SELECT id, kode, nama, kategori, harga, stok FROM produk ORDER BY id DESC");
$daftarProduk = $stmt->fetchAll();
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CATALOG</p><h2>Daftar Produk</h2></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Produk</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p>
    <?php endif; ?>

    <div class="search-box">
        <label for="search-input">Cari produk</label>
        <input type="text" id="search-input" placeholder="Ketik nama, kode, atau kategori...">
    </div>

    <div class="table-responsive">
        <table>
            <thead><tr><th>Kode</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!$daftarProduk): ?>
                <tr><td colspan="6"><div class="empty-state"><span>❀</span><strong>Belum ada produk</strong><small>Tambahkan produk komputer pertama melalui tombol di atas.</small></div></td></tr>
            <?php else: foreach ($daftarProduk as $produk): ?>
                <?php
                    $stok = (int)$produk['stok'];
                    $statusClass = $stok === 0 ? 'stock-empty' : ($stok <= 5 ? 'stock-low' : 'stock-ok');
                    $statusText = $stok === 0 ? 'Habis' : ($stok <= 5 ? 'Stok Menipis' : 'Tersedia');
                ?>
                <tr>
                    <td><span class="code-pill"><?= htmlspecialchars($produk['kode']) ?></span></td>
                    <td><strong><?= htmlspecialchars($produk['nama']) ?></strong></td>
                    <td><span class="category-pill"><?= htmlspecialchars($produk['kategori']) ?></span></td>
                    <td>Rp <?= number_format((float)$produk['harga'], 0, ',', '.') ?></td>
                    <td><span class="stock-badge <?= $statusClass ?>"><?= $stok ?> · <?= $statusText ?></span></td>
                    <td>
                        <form action="proses_hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini?\n\n<?= htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8') ?>');">
                            <input type="hidden" name="id" value="<?= (int)$produk['id'] ?>">
                            <button type="submit" class="btn-table btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
