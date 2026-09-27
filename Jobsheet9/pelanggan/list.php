<?php
$page_title = "Pelanggan";
require_once __DIR__ . '/../includes/database.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$q = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 5;

$where = '';
$params = [];
if ($q !== '') {
    $where = "WHERE nama ILIKE :q OR email ILIKE :q OR no_hp ILIKE :q OR kode ILIKE :q";
    $params[':q'] = '%' . $q . '%';
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM pelanggan $where");
$countStmt->execute($params);
$totalData = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($totalData / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("SELECT id, kode, nama, email, no_hp, alamat FROM pelanggan $where ORDER BY id DESC LIMIT :limit OFFSET :offset");
foreach ($params as $key => $value) $stmt->bindValue($key, $value, PDO::PARAM_STR);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarPelanggan = $stmt->fetchAll();

function pelangganPageUrl(int $page, string $q): string {
    $params = ['page' => $page];
    if ($q !== '') $params['q'] = $q;
    return '?' . http_build_query($params);
}
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CUSTOMERS</p><h2>Daftar Pelanggan</h2><p class="section-desc"><?= $totalData ?> data ditemukan</p></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Pelanggan</a>
    </div>

    <?php if ($flash): ?><p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p><?php endif; ?>

    <form class="search-box server-search" method="get" action="list.php">
        <div><label for="search-input">Cari pelanggan</label><input type="search" id="search-input" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Ketik nama, email, nomor HP, atau kode..."></div>
        <button class="btn btn-secondary" type="submit">Cari</button>
        <?php if ($q !== ''): ?><a class="btn btn-ghost" href="list.php">Reset</a><?php endif; ?>
    </form>

    <div class="table-responsive">
        <table>
            <thead><tr><th>Kode</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!$daftarPelanggan): ?>
                <tr><td colspan="6"><div class="empty-state"><span>✿</span><strong><?= $q !== '' ? 'Pelanggan tidak ditemukan' : 'Belum ada pelanggan' ?></strong><small><?= $q !== '' ? 'Coba kata kunci lain.' : 'Tambahkan pelanggan pertama melalui tombol di atas.' ?></small></div></td></tr>
            <?php else: foreach ($daftarPelanggan as $pelanggan): ?>
                <tr>
                    <td><span class="code-pill"><?= htmlspecialchars($pelanggan['kode']) ?></span></td>
                    <td><strong><?= htmlspecialchars($pelanggan['nama']) ?></strong></td>
                    <td><?= htmlspecialchars($pelanggan['email']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['no_hp']) ?></td>
                    <td><?= htmlspecialchars($pelanggan['alamat']) ?></td>
                    <td class="action-cell">
                        <a class="btn-table btn-edit" href="edit.php?id=<?= (int)$pelanggan['id'] ?>">Edit</a>
                        <form action="hapus.php" method="post" class="inline-form" data-confirm="Yakin ingin menghapus pelanggan ini?&#10;&#10;<?= htmlspecialchars($pelanggan['nama'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= (int)$pelanggan['id'] ?>">
                            <button type="submit" class="btn-table btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav class="pagination" aria-label="Pagination pelanggan">
        <?php if ($page > 1): ?><a href="<?= htmlspecialchars(pelangganPageUrl($page - 1, $q)) ?>">‹</a><?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?><a class="<?= $i === $page ? 'active' : '' ?>" href="<?= htmlspecialchars(pelangganPageUrl($i, $q)) ?>"><?= $i ?></a><?php endfor; ?>
        <?php if ($page < $totalPages): ?><a href="<?= htmlspecialchars(pelangganPageUrl($page + 1, $q)) ?>">›</a><?php endif; ?>
    </nav>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
