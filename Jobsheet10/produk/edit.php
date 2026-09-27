<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Produk";
require_once __DIR__ . '/../includes/database.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, kode, nama, kategori, harga, stok FROM produk WHERE id = :id");
$stmt->execute([':id' => $id]);
$produk = $stmt->fetch();

if (!$produk) {
    header('Location: list.php');
    exit;
}

include __DIR__ . '/../includes/header.php';

$kategori = ['Processor','VGA','RAM','Storage','Motherboard','PSU','Casing','Monitor','Keyboard','Mouse','Headset'];
?>
<section class="content-card form-card">
    <div class="section-heading">
        <div><p class="eyebrow">CATALOG</p><h2>Edit Produk</h2><p class="section-desc">Perbarui informasi produk yang dipilih.</p></div>
    </div>
    <?php if ($flash): ?><p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p><?php endif; ?>
    <form id="form-edit" method="POST" action="proses_edit.php">
        <input type="hidden" name="id" value="<?= (int)$produk['id'] ?>">
        <div class="form-grid">
            <p><label for="kode">Kode Produk</label><input type="text" id="kode" name="kode" value="<?= htmlspecialchars($produk['kode']) ?>" required></p>
            <p><label for="nama">Nama Produk</label><input type="text" id="nama" name="nama" value="<?= htmlspecialchars($produk['nama']) ?>" required></p>
            <p><label for="kategori">Kategori</label><select id="kategori" name="kategori" required><?php foreach ($kategori as $item): ?><option value="<?= htmlspecialchars($item) ?>" <?= $produk['kategori'] === $item ? 'selected' : '' ?>><?= htmlspecialchars($item) ?></option><?php endforeach; ?></select></p>
            <p><label for="harga">Harga (Rp)</label><input type="number" id="harga" name="harga" min="1" step="1" value="<?= htmlspecialchars((string)$produk['harga']) ?>" required></p>
            <p><label for="stok">Stok</label><input type="number" id="stok" name="stok" min="0" step="1" value="<?= (int)$produk['stok'] ?>" required></p>
        </div>
        <div class="form-actions"><a class="btn btn-ghost" href="list.php">Batal</a><button class="btn btn-primary" type="submit">Simpan Perubahan</button></div>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
