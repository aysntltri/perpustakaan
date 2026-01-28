<?php
session_start();
if ($_SESSION['role'] != 'siswa') {
    header("location:../login.php");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="menu">
    <h2>Dashboard Siswa</h2>
    <p>Selamat datang, <b><?= $_SESSION['nama']; ?></b></p>

    <a href="pinjam.php">📚 Peminjaman Buku</a>
    <a href="kembali.php">↩️ Pengembalian Buku</a>
    <a href="../logout.php">🚪 Logout</a>
</div>