<?php
$page_title = "Produk";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarProduk = $_SESSION['produk'] ?? [];
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CATALOG</p><h2>Daftar Produk</h2></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Produk</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>

    <div class="search-box">
        <label for="search-input">Cari produk</label>
        <input type="text" id="search-input" placeholder="Ketik nama, kode, atau kategori...">
    </div>

    <div class="table-responsive">
        <table>
            <thead><tr><th>Kode</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (empty($daftarProduk)): ?>
                <tr><td colspan="6"><div class="empty-state"><span>❀</span><strong>Belum ada produk</strong><small>Tambahkan produk komputer pertama melalui tombol di atas.</small></div></td></tr>
            <?php else: foreach ($daftarProduk as $produk): ?>
                <?php
                    $stok = (int)$produk['stok'];
                    $statusClass = $stok === 0 ? 'stock-empty' : ($stok <= 5 ? 'stock-low' : 'stock-ok');
                    $statusText = $stok === 0 ? 'Habis' : ($stok <= 5 ? 'Stok Menipis' : 'Tersedia');
                ?>
                <tr>
                    <td><span class="code-pill"><?php echo htmlspecialchars($produk['kode']); ?></span></td>
                    <td><strong><?php echo htmlspecialchars($produk['nama']); ?></strong></td>
                    <td><span class="category-pill"><?php echo htmlspecialchars($produk['kategori']); ?></span></td>
                    <td>Rp <?php echo number_format((int)$produk['harga'], 0, ',', '.'); ?></td>
                    <td><span class="stock-badge <?php echo $statusClass; ?>"><?php echo $stok; ?> · <?php echo $statusText; ?></span></td>
                    <td><button type="button" class="btn-table btn-hapus">Hapus</button></td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
