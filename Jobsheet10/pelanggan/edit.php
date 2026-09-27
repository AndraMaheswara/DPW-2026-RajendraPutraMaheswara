<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Pelanggan";
require_once __DIR__ . '/../includes/database.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, kode, nama, email, no_hp, alamat FROM pelanggan WHERE id = :id");
$stmt->execute([':id' => $id]);
$pelanggan = $stmt->fetch();

if (!$pelanggan) {
    header('Location: list.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
?>
<section class="content-card form-card">
    <div class="section-heading">
        <div><p class="eyebrow">CUSTOMERS</p><h2>Edit Pelanggan</h2><p class="section-desc">Perbarui informasi pelanggan yang dipilih.</p></div>
    </div>
    <?php if ($flash): ?><p class="flash flash-<?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p><?php endif; ?>
    <form id="form-edit" method="POST" action="proses_edit.php">
        <input type="hidden" name="id" value="<?= (int)$pelanggan['id'] ?>">
        <div class="form-grid">
            <p><label for="kode">Kode Pelanggan</label><input type="text" id="kode" value="<?= htmlspecialchars($pelanggan['kode']) ?>" readonly></p>
            <p><label for="nama">Nama</label><input type="text" id="nama" name="nama" value="<?= htmlspecialchars($pelanggan['nama']) ?>" required></p>
            <p><label for="email">Email</label><input type="email" id="email" name="email" value="<?= htmlspecialchars($pelanggan['email']) ?>" required></p>
            <p><label for="no_hp">Nomor HP</label><input type="text" id="no_hp" name="no_hp" value="<?= htmlspecialchars($pelanggan['no_hp']) ?>" required></p>
            <p class="full"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" rows="4" required><?= htmlspecialchars($pelanggan['alamat']) ?></textarea></p>
        </div>
        <div class="form-actions"><a class="btn btn-ghost" href="list.php">Batal</a><button class="btn btn-primary" type="submit">Simpan Perubahan</button></div>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
