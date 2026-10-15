# UTS Web 1 - Sistem Aplikasi Kantin Kampus

**Nama:** Nabila  
**NIM:** 25012047  
**Mata Kuliah:** Pemrograman Web 1  
**Repository:** https://github.com/Nabila0906/uts-web1-nabila-25012047

Sistem pemesanan makanan kantin online sederhana berbasis PHP Native. Dibuat untuk memenuhi kriteria penilaian UTS Web 1 dengan fokus pada validasi server-side.

### ✅ Pemenuhan Soal UTS (Halaman 4)

**U03 - Validasi Input Tidak Boleh Kosong**
- Aturan: Nama, kode makanan, jumlah tidak boleh kosong
- Implementasi: di `proses.php` pakai `empty()` dan `trim()`
- Bukti: `dokumentasi/pengujian/U03-kosong.png`

**U04 - Validasi Format & Kode Salah**
- Aturan: Jumlah harus angka >0 dan kode makanan harus terdaftar
- Implementasi: `is_numeric()` dan `array_key_exists()` di `proses.php`
- Bukti: `dokumentasi/pengujian/U04-kode-salah.png`

**U05 - Validasi Stok & Transaksi**
- Aturan: Jika stok cukup -> berhasil, jika tidak -> gagal
- Bukti: `U05-berhasil.png` dan `U05-gagal-stok.png`

### 📁 Struktur Folder
- `index.php` - Halaman utama
- `proses.php` - Pusat logika U03 U04 U05
- `keranjang.php` - Hasil pesanan
- `dokumentasi/pengujian/` - Screenshot WAJIB
- `assets/`, `data/`, `includes/`

### 🚀 Cara Menjalankan
1. Copy ke `C:/xampp/htdocs/`
2. Start Apache
3. Buka `http://localhost/uts-web1-nabila-25012047/index.php`

### 💻 Teknologi
PHP 8 Native, HTML, CSS, Git - 1 commit bersih atas nama Nabila0906