<?php
$page_title = "Tambah Pelanggan";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="content-card form-card">
    <div class="section-heading">
        <div><p class="eyebrow">CUSTOMERS</p><h2>Tambah Pelanggan</h2><p class="section-desc">Masukkan informasi pelanggan baru.</p></div>
    </div>
    <?php if ($flash): ?><p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p><?php endif; ?>
    <form id="form-tambah" method="POST" action="proses_tambah.php">
        <div class="form-grid">
            <p><label for="nama">Nama</label><input type="text" id="nama" name="nama" required></p>
            <p><label for="email">Email</label><input type="email" id="email" name="email" required></p>
            <p><label for="no_hp">Nomor HP</label><input type="text" id="no_hp" name="no_hp" required></p>
            <p class="full"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="4" required></textarea></p>
        </div>
        <div class="form-actions"><a class="btn btn-ghost" href="list.php">Batal</a><button class="btn btn-primary" type="submit">Simpan Pelanggan</button></div>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
