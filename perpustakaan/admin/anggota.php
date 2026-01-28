<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['role'] != 'admin') {
    header("location:../login.php");
}

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM users WHERE id='$_GET[hapus]'");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">
<div class="menu">
    <h2>Kelola Anggota</h2>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT * FROM users WHERE role='siswa'");
        while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td>
                    <?= $no++ ?>
                </td>
                <td>
                    <?= $d['nama'] ?>
                </td>
                <td>
                    <?= $d['username'] ?>
                </td>
                <td>
                                <?= $d['role'] ?>
                    </td>
                    <td><a href="?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus akun?')">Hapus</a></td>
                </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Kembali</a>
</div>