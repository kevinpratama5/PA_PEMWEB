<?php
require_once "db.php";
require_once "otentikasi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO produk (nama, deskripsi, harga, kategori, stok) VALUES ('$nama', '$deskripsi', '$harga', '$kategori', '$stok')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal menambah produk: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="post" action="tambah_produk.php">
        <label>Nama Produk:</label>
        <input type="text" name="nama" required><br>
        
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br>
        
        <label>Harga:</label>
        <input type="number" name="harga" required><br>
        
        <label>Kategori:</label>
        <input type="text" name="kategori" required><br>
        
        <label>Stok:</label>
        <input type="number" name="stok" required><br>
        
        <button type="submit">Tambah Produk</button>
    </form>
</body>
</html>
