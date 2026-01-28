<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['role'] != 'admin') {
    header("location:../login.php");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
<div class="menu">
    <h2>Data Transaksi</h2>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Jumlah</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT 
            t.id,
            u.nama,
            b.judul,
            t.jumlah,
            t.kelas,
            t.jurusan,
            t.tanggal_pinjam,
            t.jam,
            t.batas_kembali,
            t.status
        FROM transaksi t 
        JOIN users u ON t.user_id = u.id 
        JOIN buku b ON t.buku_id = b.id
        ORDER BY t.id DESC");

        while ($d = mysqli_fetch_assoc($q)) {
            if ($d['status'] == 'dipinjam' && strtotime($d['batas_kembali']) < time()) {
                $status = "<span style='color:red;font-weight:bold'>TELAT</span>";
            } else {
                $status = $d['status'];
            }
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama'] ?></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><?= $d['kelas'] ?></td>
                <td><?= $d['jurusan'] ?></td>
                <td><?= $d['tanggal_pinjam'] ?></td>
                <td><?= $d['jam'] ?></td>
                <td><?= $d['batas_kembali'] ?></td>
                <td><?= $status ?></td>
            </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Kembali</a>
</div>