<?php
require_once "db.php";
require_once "otentikasi.php";

$produk = [
    [
        'nama' => 'Gelato Mangga',
        'deskripsi' => 'Gelato rasa mangga segar.',
        'harga' => 20000,
        'url_gambar' => 'images/gelato_mangga.jpg'
    ],
    [
        'nama' => 'Gelato Keju',
        'deskripsi' => 'Gelato rasa keju creamy.',
        'harga' => 22000,
        'url_gambar' => 'images/gelato_keju.jpg'
    ],
    [
        'nama' => 'Gelato Avocado',
        'deskripsi' => 'Gelato rasa alpukat yang lembut.',
        'harga' => 25000,
        'url_gambar' => 'images/gelato_avocado.jpg'
    ],
    [
        'nama' => 'Gelato Banana',
        'deskripsi' => 'Gelato pisang yang manis.',
        'harga' => 20000,
        'url_gambar' => 'images/gelato_banana.jpg'
    ],
    [
        'nama' => 'Gelato Japanese Matcha',
        'deskripsi' => 'Gelato matcha khas Jepang.',
        'harga' => 28000,
        'url_gambar' => 'images/gelato_japanese_matcha.jpg'
    ],
    [
        'nama' => 'Gelato Vanila',
        'deskripsi' => 'Gelato vanila klasik.',
        'harga' => 18000,
        'url_gambar' => 'images/gelato_vanila.jpg'
    ],
    [
        'nama' => 'Gelato Black Forest',
        'deskripsi' => 'Gelato black forest dengan ceri.',
        'harga' => 30000,
        'url_gambar' => 'images/gelato_blackforet.jpg'
    ],
    [
        'nama' => 'Gelato Bubblegum',
        'deskripsi' => 'Gelato rasa permen karet.',
        'harga' => 21000,
        'url_gambar' => 'images/gelato_bubblegum.jpg'
    ],
    [
        'nama' => 'Gelato Strawberry',
        'deskripsi' => 'Gelato strawberry segar.',
        'harga' => 22000,
        'url_gambar' => 'images/gelato_strawberry.jpg'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Gelato</title>
    <link rel="stylesheet" href="styles/beranda.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <h1>Toko Gelato</h1>
            <img src="images/logo.jpg" alt="Logo Toko Gelato">
        </div>
        
        <div class="link-nav">
            <a href="login.php">Masuk</a>
            <a href="register.php">Daftar</a>
        </div>

        <div class="hamburger-menu" id="hamburger-menu">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <h2>Selamat Datang di Toko Gelato</h2>
        <p>Nikmati kelezatan gelato Italia autentik dengan berbagai pilihan rasa</p>
    </div>

    <!-- Pencarian Produk -->
    <div class="pencarian">
        <input type="text" id="input-pencarian" placeholder="Cari produk...">
    </div>

    <!-- Grid Produk -->
    <div class="kontainer">
        <div class="grid-produk">
            <?php foreach ($produk as $item): ?>
                <div class="kartu-produk">
                    <img src="<?php echo htmlspecialchars($item['url_gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>" class="gambar-produk">
                    <div class="info-produk">
                        <h3><?php echo htmlspecialchars($item['nama']); ?></h3>
                        <p class="deskripsi"><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                        <p class="harga">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                        <button class="tombol tombol-utama">Tambah ke Keranjang</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Toko Gelato menyajikan gelato Italia autentik dengan bahan-bahan premium.</p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>Email: info@tokogelato.com</p>
                <p>Telepon: (021) 1234-5678</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Toko Gelato. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>