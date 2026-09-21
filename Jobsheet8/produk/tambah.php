<?php
$page_title = "Tambah Produk";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$kategori = ['Processor','VGA','RAM','Storage','Motherboard','PSU','Casing','Monitor','Keyboard','Mouse','Headset'];
?>
<section class="content-card form-card">
    <div class="section-heading">
        <div><p class="eyebrow">CATALOG</p><h2>Tambah Produk</h2><p class="section-desc">Tambahkan komponen atau periferal komputer ke katalog.</p></div>
    </div>
    <?php if ($flash): ?><p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p><?php endif; ?>
    <form id="form-tambah" method="POST" action="proses_tambah.php">
        <div class="form-grid">
            <p><label for="kode">Kode Produk</label><input type="text" id="kode" name="kode" placeholder="PRD-001" required></p>
            <p><label for="nama">Nama Produk</label><input type="text" id="nama" name="nama" placeholder="Contoh: Ryzen 5 5600" required></p>
            <p><label for="kategori">Kategori</label><select id="kategori" name="kategori" required><option value="">Pilih kategori</option><?php foreach ($kategori as $item): ?><option value="<?php echo htmlspecialchars($item); ?>"><?php echo htmlspecialchars($item); ?></option><?php endforeach; ?></select></p>
            <p><label for="harga">Harga (Rp)</label><input type="number" id="harga" name="harga" min="1" step="1" placeholder="1500000" required></p>
            <p><label for="stok">Stok</label><input type="number" id="stok" name="stok" min="0" step="1" placeholder="10" required></p>
        </div>
        <div class="form-actions"><a class="btn btn-ghost" href="list.php">Batal</a><button class="btn btn-primary" type="submit">Simpan Produk</button></div>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
