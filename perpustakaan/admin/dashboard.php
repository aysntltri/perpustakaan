<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location:../login.php");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="menu">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <b><?= $_SESSION['nama']; ?></b></p>

    <a href="buku.php">📘 Kelola Buku</a>
    <a href="anggota.php">👥 Kelola Anggota</a>
    <a href="transaksi.php">🧾 Data Transaksi</a>
    <a href="../logout.php">🚪 Logout</a>
</div>