<?php
session_start();

// DAFTAR MENU VALID - sesuaikan dengan menu kamu
$menu_valid = ['M001','M002','M003','M004','M005','M006'];

if (!isset($_SESSION['keranjang'])) $_SESSION['keranjang'] = [];

$kode = $_POST['kode'] ?? '';
$jml_raw = $_POST['jumlah'] ?? '';

// ===== U03 VALIDASI JUMLAH =====
if ($jml_raw === '') { $_SESSION['error']="U03: Jumlah tidak boleh kosong. Keranjang tidak berubah."; header("Location: index.php"); exit; }
if (!is_numeric($jml_raw)) { $_SESSION['error']="U03: Jumlah harus angka. Keranjang tidak berubah."; header("Location: index.php"); exit; }
if ((float)$jml_raw != (int)$jml_raw) { $_SESSION['error']="U03: Jumlah tidak boleh pecahan ($jml_raw). Keranjang tidak berubah."; header("Location: index.php"); exit; }
$jml = (int)$jml_raw;
if ($jml == 0) { $_SESSION['error']="U03: Jumlah tidak boleh 0. Keranjang tidak berubah."; header("Location: index.php"); exit; }
if ($jml < 0) { $_SESSION['error']="U03: Jumlah tidak boleh negatif ($jml). Keranjang tidak berubah."; header("Location: index.php"); exit; }
if ($jml > 10) { $_SESSION['error']="U03: Jumlah tidak boleh lebih dari 10 (Anda kirim $jml). Keranjang tidak berubah."; header("Location: index.php"); exit; }

// ===== U04 VALIDASI KODE TIDAK DIKENAL =====
if (!in_array($kode, $menu_valid)) {
    $_SESSION['error']="U04: Kode menu tidak dikenal ($kode). Server menolak. Keranjang tidak berubah.";
    header("Location: index.php"); exit;
}

// ===== U05 VALIDASI JUMLAH GABUNG TIDAK BOLEH LEWAT 10 =====
$sudah_ada = $_SESSION['keranjang'][$kode] ?? 0;
if (($sudah_ada + $jml) > 10) {
    $_SESSION['error']="U05: Permintaan ditolak. Sudah ada $sudah_ada, tambah $jml = ".($sudah_ada+$jml)." melebihi 10. Jumlah tetap $sudah_ada (10 maks).";
    header("Location: index.php"); exit;
}

// Jika lolos semua
$_SESSION['keranjang'][$kode] = $sudah_ada + $jml;
if ($sudah_ada > 0) {
    $_SESSION['success']="U05: Jumlah digabung. $kode dari $sudah_ada + $jml = ".$_SESSION['keranjang'][$kode];
} else {
    $_SESSION['success']="Berhasil tambah $kode x$jml";
}
header("Location: index.php"); exit;
?>