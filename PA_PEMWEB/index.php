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
    ],
    [
        'nama' => 'Gelato Kopi',
        'deskripsi' => 'Gelato rasa Kopi kuat.',
        'harga' => 17000,
        'url_gambar' => 'images/gelato_kopi.jpg'
    ],
    [
        'nama' => 'Gelato cookies and cream',
        'deskripsi' => 'Gelato rasa Cookies and Cream.',
        'harga' => 29000,
        'url_gambar' => 'images/gelato_cookies_and_cream.jpg'
    ],
    [
        'nama' => 'gelato Stracciatella',
        'deskripsi' => 'Gelato rasa Stracciatella.',
        'harga' => 30000,
        'url_gambar' => 'images/gelato_Stracciatella.jpg'
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
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Masuk</a>
                <a href="register.php">Daftar</a>
            <?php endif; ?>
        </div>

        <div class="hamburger-menu" id="hamburger-menu">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <!-- Banner -->
    <div id="home" class="banner">
        <h2>Selamat Datang di Toko Gelato</h2>
        <p>Nikmati kelezatan gelato Italia autentik dengan berbagai pilihan rasa</p>
    </div>

    <!-- Pencarian Produk -->
    <div class="pencarian">
        <input type="text" id="input-pencarian" placeholder="Cari produk...">
    </div>

    <!-- Filter dan Sorting Produk -->
    <div class="filter-section">
        <form method="GET" action="index.php">
            <!-- Filter Kategori -->
            <select name="kategori" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="Buah" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == 'Buah') echo 'selected'; ?>>Buah</option>
                <option value="Dessert" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == 'Dessert') echo 'selected'; ?>>Dessert</option>
                <option value="Permen" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == 'Permen') echo 'selected'; ?>>Permen</option>
            </select>
            
            <!-- Sortir Harga -->
            <select name="sortir_harga" onchange="this.form.submit()">
                <option value="">Urutkan Harga</option>
                <option value="murah" <?php if (isset($_GET['sortir_harga']) && $_GET['sortir_harga'] == 'murah') echo 'selected'; ?>>Termurah</option>
                <option value="mahal" <?php if (isset($_GET['sortir_harga']) && $_GET['sortir_harga'] == 'mahal') echo 'selected'; ?>>Termahal</option>
            </select>
        </form>
    </div>

    <!-- Grid Produk -->
    <div class="kontainer">
    <div class="grid-produk">
    <?php
    // Ambil filter kategori dan sortir harga dari form
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
    $sortir_harga = isset($_GET['sortir_harga']) ? $_GET['sortir_harga'] : '';

    // Query dasar
    $query = "SELECT * FROM produk";
    
    // Tambahkan kondisi kategori jika ada
    if (!empty($kategori)) {
        $query .= " WHERE kategori = '$kategori'";
    }

    // Tambahkan kondisi sortir harga jika ada
    if ($sortir_harga === 'murah') {
        $query .= " ORDER BY harga ASC";
    } elseif ($sortir_harga === 'mahal') {
        $query .= " ORDER BY harga DESC";
    }

    $result = mysqli_query($conn, $query);

    while ($item = mysqli_fetch_assoc($result)) : ?>
        <div class="kartu-produk">
            <img src="<?php echo htmlspecialchars($item['url_gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>">
            <h3><?php echo htmlspecialchars($item['nama']); ?></h3>
            <p>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>

            <?php if (isset($_SESSION['user_id'])): ?>
                <form method="POST" action="favorit.php">
                    <input type="hidden" name="id_produk" value="<?php echo $item['id_produk']; ?>">
                    <button type="submit" class="tombol">Tambah ke Favorit</button>
                </form>
                <form method="POST" action="keranjang.php">
                    <input type="hidden" name="id_produk" value="<?php echo $item['id_produk']; ?>">
                    <button type="submit" class="tombol">Tambah ke Keranjang</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="tombol">Login untuk Beli</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>
    </div>

    <!-- Bagian About -->
    <div id="about" class="kontainer">
        <h2>About Us</h2>
        <p>Toko Gelato adalah toko es krim khusus yang menyajikan gelato autentik dengan bahan-bahan terbaik. Kami menawarkan berbagai rasa unik yang dibuat dengan cinta untuk memberikan pengalaman yang tidak terlupakan bagi para pencinta es krim.</p>
        <p>Dengan komitmen untuk kualitas, Toko Gelato selalu menggunakan bahan-bahan alami dan segar tanpa bahan pengawet buatan.</p>
        <p>Alamat kami: Jalan Es Krim No. 123, Jakarta.</p>
        <p>Hubungi kami di: info@tokogelato.com | Telepon: (021) 1234-5678</p>
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
