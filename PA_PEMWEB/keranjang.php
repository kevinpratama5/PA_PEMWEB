<?php
session_start();
include 'db.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data keranjang untuk pengguna yang sedang login
$query = "SELECT keranjang.id_keranjang, produk.nama, produk.harga, produk.url_gambar, keranjang.jumlah 
          FROM keranjang
          JOIN produk ON keranjang.id_produk = produk.id_produk
          WHERE keranjang.id_pengguna = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Toko Gelato</title>
    <link rel="stylesheet" href="styles/keranjang.css">
</head>
<body>

<h2>Keranjang Belanja</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($item = mysqli_fetch_assoc($result)) :
                $subtotal = $item['harga'] * $item['jumlah'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($item['url_gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>" width="50"></td>
                    <td><?php echo htmlspecialchars($item['nama']); ?></td>
                    <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $item['jumlah']; ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    <td>
                        <form method="POST" action="hapus_dari_keranjang.php">
                            <input type="hidden" name="id_keranjang" value="<?php echo $item['id_keranjang']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h3>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></h3>
    <a href="checkout.php" class="tombol">Lanjut ke Checkout</a>
<?php else: ?>
    <p>Keranjang Anda kosong. <a href="index.php">Belanja sekarang</a>.</p>
<?php endif; ?>

</body>
</html>
