<?php
$page_title = "Pelanggan";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarPelanggan = $_SESSION['pelanggan'] ?? [];
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CUSTOMERS</p><h2>Daftar Pelanggan</h2></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Pelanggan</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
    <?php endif; ?>

    <div class="search-box">
        <label for="search-input">Cari pelanggan</label>
        <input type="text" id="search-input" placeholder="Ketik nama, email, atau nomor HP...">
    </div>

    <div class="table-responsive">
        <table>
            <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (empty($daftarPelanggan)): ?>
                <tr><td colspan="6"><div class="empty-state"><span>✿</span><strong>Belum ada pelanggan</strong><small>Tambahkan pelanggan pertama melalui tombol di atas.</small></div></td></tr>
            <?php else: foreach ($daftarPelanggan as $pelanggan): ?>
                <tr>
                    <td><span class="code-pill"><?php echo htmlspecialchars($pelanggan['id']); ?></span></td>
                    <td><strong><?php echo htmlspecialchars($pelanggan['nama']); ?></strong></td>
                    <td><?php echo htmlspecialchars($pelanggan['email']); ?></td>
                    <td><?php echo htmlspecialchars($pelanggan['no_hp']); ?></td>
                    <td><?php echo htmlspecialchars($pelanggan['alamat']); ?></td>
                    <td><button type="button" class="btn-table btn-hapus">Hapus</button></td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
