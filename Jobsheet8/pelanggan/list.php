<?php
$page_title = "Pelanggan";
require_once __DIR__ . '/../includes/database.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$stmt = $pdo->query("SELECT id, kode, nama, email, no_hp, alamat FROM pelanggan ORDER BY id DESC");
$daftarPelanggan = $stmt->fetchAll();
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CUSTOMERS</p><h2>Daftar Pelanggan</h2></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Pelanggan</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p>
    <?php endif; ?>

    <div class="search-box">
        <label for="search-input">Cari pelanggan</label>
        <input type="text" id="search-input" placeholder="Ketik nama, email, atau nomor HP...">
    </div>

    <div class="table-responsive">
        <table>
            <thead><tr><th>Kode</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!$daftarPelanggan): ?>
                <tr><td colspan="6"><div class="empty-state"><span>✿</span><strong>Belum ada pelanggan</strong><small>Tambahkan pelanggan pertama melalui tombol di atas.</small></div></td></tr>
            <?php else: foreach ($daftarPelanggan as $pelanggan): ?>
                <tr>
                    <td><span class="code-pill"><?= htmlspecialchars($pelanggan['kode']) ?></span></td>
                    <td><strong><?= htmlspecialchars($pelanggan['nama']) ?></strong></td>
                    <td><?= htmlspecialchars($pelanggan['email']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['no_hp']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['alamat']) ?></td>
                    <td>
                        <form action="proses_hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?\n\n<?= htmlspecialchars($pelanggan['nama'], ENT_QUOTES, 'UTF-8') ?>');">
                            <input type="hidden" name="id" value="<?= (int)$pelanggan['id'] ?>">
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
