<?php
require_once "db.php";
require_once "otentikasi.php";

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id_produk = '$id'";
$hasil = mysqli_query($koneksi, $query);
$produk = mysqli_fetch_assoc($hasil);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];

    $query = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga='$harga', kategori='$kategori', stok='$stok' WHERE id_produk = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gagal mengedit produk: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form method="post">
        <label>Nama Produk:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($produk['nama']); ?>" required><br>
        
        <label>Deskripsi:</label>
        <textarea name="deskripsi" required><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea><br>
        
        <label>Harga:</label>
        <input type="number" name="harga" value="<?php echo $produk['harga']; ?>" required><br>
        
        <label>Kategori:</label>
        <input type="text" name="kategori" value="<?php echo htmlspecialchars($produk['kategori']); ?>" required><br>
        
        <label>Stok:</label>
        <input type="number" name="stok" value="<?php echo $produk['stok']; ?>" required><br>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
