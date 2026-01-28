<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['role'] != 'admin') {
    header("location:../login.php");
}

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO buku VALUES(NULL,'$_POST[judul]','$_POST[pengarang]','$_POST[tahun]','$_POST[stok]')");
}

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM buku WHERE id='$_GET[hapus]'");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
<div class="menu">
    <h2>Kelola Buku</h2>

    <form method="post">
        <input type="text" name="judul" placeholder="Judul Buku" required>
        <input type="text" name="pengarang" placeholder="Pengarang/Guru Mapel" required>
        <input type="number" name="tahun" placeholder="Tahun" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <button name="simpan">Simpan</button>
    </form>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT * FROM buku");
        while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['pengarang'] ?></td>
                <td><?= $d['tahun'] ?></td>
                <td><?= $d['stok'] ?></td>
                <td><a href="?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
            </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Kembali</a>
</div>