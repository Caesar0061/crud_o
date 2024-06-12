<?php
include('koneksi.php');

// Ambil ID dari parameter URL dan validasi
$id = $_GET['id'];
if (!is_numeric($id)) {
    die("ID tidak valid!");
}

// Menggunakan prepared statements untuk mencegah SQL injection
$stmt = $koneksi->prepare("DELETE FROM produk WHERE id = ?");
$stmt->bind_param('i', $id); // 'i' menunjukkan tipe data integer

// Eksekusi query
if ($stmt->execute()) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    // Menangani kesalahan dengan lebih baik
    die("Query Error: " . $stmt->errno . " - " . $stmt->error);
}

// Menutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>
