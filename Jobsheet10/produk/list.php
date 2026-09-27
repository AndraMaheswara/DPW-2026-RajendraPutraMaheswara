<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);
$page_title = "Produk";
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
    $where = "WHERE nama ILIKE :q OR kode ILIKE :q OR kategori ILIKE :q";
    $params[':q'] = '%' . $q . '%';
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM produk $where");
$countStmt->execute($params);
$totalData = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($totalData / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("SELECT id, kode, nama, kategori, harga, stok FROM produk $where ORDER BY id DESC LIMIT :limit OFFSET :offset");
foreach ($params as $key => $value) $stmt->bindValue($key, $value, PDO::PARAM_STR);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarProduk = $stmt->fetchAll();

function produkPageUrl(int $page, string $q): string {
    $params = ['page' => $page];
    if ($q !== '') $params['q'] = $q;
    return '?' . http_build_query($params);
}
?>
<section class="content-card">
    <div class="section-heading">
        <div><p class="eyebrow">CATALOG</p><h2>Daftar Produk</h2><p class="section-desc"><?= $totalData ?> data ditemukan</p></div>
        <a class="btn btn-primary" href="tambah.php">＋ Tambah Produk</a>
    </div>

    <?php if ($flash): ?><p class="flash flash-<?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['pesan']) ?></p><?php endif; ?>

    <form class="search-box server-search" method="get" action="list.php">
        <div><label for="search-input">Cari produk</label><input type="search" id="search-input" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Ketik nama, kode, atau kategori..."></div>
        <button class="btn btn-secondary" type="submit">Cari</button>
        <?php if ($q !== ''): ?><a class="btn btn-ghost" href="list.php">Reset</a><?php endif; ?>
    </form>

    <div class="table-responsive">
        <table>
            <thead><tr><th>Kode</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!$daftarProduk): ?>
                <tr><td colspan="6"><div class="empty-state"><span>❀</span><strong><?= $q !== '' ? 'Produk tidak ditemukan' : 'Belum ada produk' ?></strong><small><?= $q !== '' ? 'Coba kata kunci lain.' : 'Tambahkan produk pertama melalui tombol di atas.' ?></small></div></td></tr>
            <?php else: foreach ($daftarProduk as $produk): ?>
                <?php $stok = (int)$produk['stok']; $statusClass = $stok === 0 ? 'stock-empty' : ($stok <= 5 ? 'stock-low' : 'stock-ok'); $statusText = $stok === 0 ? 'Habis' : ($stok <= 5 ? 'Stok Menipis' : 'Tersedia'); ?>
                <tr>
                    <td><span class="code-pill"><?= htmlspecialchars($produk['kode']) ?></span></td>
                    <td><strong><?= htmlspecialchars($produk['nama']) ?></strong></td>
                    <td><span class="category-pill"><?= htmlspecialchars($produk['kategori']) ?></span></td>
                    <td>Rp <?= number_format((float)$produk['harga'], 0, ',', '.') ?></td>
                    <td><span class="stock-badge <?= $statusClass ?>"><?= $stok ?> · <?= $statusText ?></span></td>
                    <td class="action-cell">
                        <?php if ($sudahLogin): ?>
                            <a class="btn-table btn-edit" href="edit.php?id=<?= (int)$produk['id'] ?>">Edit</a>
                            <form action="hapus.php" method="post" class="inline-form" data-confirm="Yakin ingin menghapus produk ini?&#10;&#10;<?= htmlspecialchars($produk['nama'], ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="id" value="<?= (int)$produk['id'] ?>">
                                <button type="submit" class="btn-table btn-danger">Hapus</button>
                            </form>
                        <?php else: ?>
                            <a class="btn-table btn-edit" href="../auth/login.php">Login untuk mengelola</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav class="pagination" aria-label="Pagination produk">
        <?php if ($page > 1): ?><a href="<?= htmlspecialchars(produkPageUrl($page - 1, $q)) ?>">‹</a><?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?><a class="<?= $i === $page ? 'active' : '' ?>" href="<?= htmlspecialchars(produkPageUrl($i, $q)) ?>"><?= $i ?></a><?php endfor; ?>
        <?php if ($page < $totalPages): ?><a href="<?= htmlspecialchars(produkPageUrl($page + 1, $q)) ?>"><?= '›' ?></a><?php endif; ?>
    </nav>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
