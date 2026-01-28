<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['role'] != 'siswa') {
    header("location:../login.php");
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $q = mysqli_query($conn, "SELECT * FROM transaksi WHERE id='$id'");
    $d = mysqli_fetch_assoc($q);

    mysqli_query($conn, "UPDATE buku SET stok = stok + $d[jumlah] WHERE id='$d[buku_id]'");

    mysqli_query($conn, "UPDATE transaksi SET status='kembali', tanggal_kembali=NOW() WHERE id='$id'");

    echo "<script>alert('Buku berhasil dikembalikan'); location='kembali.php';</script>";
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="menu">
    <h2>Pengembalian Buku</h2>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Buku</th>
            <th>Jumlah</th>
            <th>Batas Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT t.*,b.judul FROM transaksi t 
JOIN buku b ON t.buku_id=b.id 
WHERE t.user_id='$_SESSION[id]' AND t.status='dipinjam'");

        while ($d = mysqli_fetch_assoc($q)) {
            $status = (strtotime($d['batas_kembali']) < time()) ? "TELAT" : "AMAN";
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><?= $d['batas_kembali'] ?></td>
                <td><?= $status ?></td>
                <td><a href="?id=<?= $d['id'] ?>">Kembalikan</a></td>
            </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Kembali</a>
</div>