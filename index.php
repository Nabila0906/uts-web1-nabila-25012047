<?php
session_start();
require_once __DIR__ . '/data/menu.php';
require_once __DIR__ . '/includes/header.php';

$kataKunci = trim($_GET['cari'] ?? '');
$hasilMenu = [];

foreach ($daftarMenu as $menu) {
    if (
        $kataKunci === '' ||
        stripos($menu['nama'], $kataKunci) !== false ||
        stripos($menu['kategori'], $kataKunci) !== false ||
        stripos($menu['kode'], $kataKunci) !== false
    ) {
        $hasilMenu[] = $menu;
    }
}

// Tangani pesan flash/error sementara jika ada
$pesanError = $_SESSION['error'] ?? '';
$pesanSukses = $_SESSION['sukses'] ?? '';
unset($_SESSION['error'], $_SESSION['sukses']);
?>

<main class="container">
    <h1>Daftar Menu Kantin</h1>

    <!-- Tampilkan Pesan Error / Sukses -->
    <?php if (!empty($pesanError)): ?>
        <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 15px; border: 1px solid red;">
            <?= htmlspecialchars($pesanError, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pesanSukses)): ?>
        <div style="color: green; background: #e6ffe6; padding: 10px; margin-bottom: 15px; border: 1px solid green;">
            <?= htmlspecialchars($pesanSukses, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <form method="GET" action="index.php">
        <input
            type="text"
            name="cari"
            placeholder="Cari nama, kategori, atau kode menu"
            value="<?= htmlspecialchars($kataKunci, ENT_QUOTES, 'UTF-8'); ?>"
        >
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a>
    </form>
<?php if (session_status()===PHP_SESSION_NONE) session_start(); ?>
<?php if (!empty($_SESSION['error'])): ?>
<div style="background:#ffcccc; color:#b00; padding:12px; border:1px solid red; margin-bottom:15px; font-weight:bold;">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
</div>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
<div style="background:#ccffcc; color:#060; padding:12px; border:1px solid green; margin-bottom:15px;">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
</div>
<?php endif; ?>
    <h2>Menu yang Tersedia</h2>

    <?php if (count($hasilMenu) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hasilMenu as $menu): ?>
                    <tr>
                        <td><?= htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($menu['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($menu['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>Rp<?= number_format($menu['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <!-- Form Pemesanan via POST -->
                            <form action="proses.php" method="POST" style="display: flex; gap: 5px;">
                                <input type="hidden" name="kode" value="<?= htmlspecialchars($menu['kode'], ENT_QUOTES, 'UTF-8'); ?>">
                               <input type="text" name="jumlah" value="1">
                                <button type="submit">Tambah</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Menu yang dicari tidak ditemukan.</p>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>