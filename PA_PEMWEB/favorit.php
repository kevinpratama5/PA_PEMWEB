<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $id_pengguna = $_SESSION['user_id'];

    // Cek apakah produk sudah ada di favorit
    $query = "SELECT * FROM favorit WHERE id_pengguna = '$id_pengguna' AND id_produk = '$id_produk'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Jika belum ada, tambahkan ke favorit
        $query = "INSERT INTO favorit (id_pengguna, id_produk) VALUES ('$id_pengguna', '$id_produk')";
        mysqli_query($conn, $query);
    }
    
    header("Location: index.php");
    exit();
}
?>