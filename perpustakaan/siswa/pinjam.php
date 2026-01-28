<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['role'] != 'siswa') {
    header("location:../login.php");
}

if (isset($_POST['pinjam'])) {

    $user = $_SESSION['id'];
    $buku = $_POST['buku'];
    $jumlah = $_POST['jumlah'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $durasi_jam = $_POST['durasi_jam'];
    $durasi_menit = $_POST['durasi_menit'];

    $total_menit = ($durasi_jam * 60) + $durasi_menit;

    if ($total_menit <= 0 || $total_menit > 4320) {
        echo "<script>alert('Durasi harus 1 menit - 72 jam');</script>";
        exit;
    }

    // cek stok
    $q = mysqli_query($conn, "SELECT stok FROM buku WHERE id='$buku'");
    $d = mysqli_fetch_assoc($q);

    if ($d['stok'] < $jumlah) {
        echo "<script>alert('Stok tidak mencukupi');</script>";
        exit;
    }

    $datetime = $tanggal . ' ' . $jam;
    $batas = date('Y-m-d H:i:s', strtotime("+$total_menit minutes", strtotime($datetime)));

    mysqli_query($conn, "INSERT INTO transaksi 
    (user_id,buku_id,jumlah,tanggal_pinjam,jam,batas_kembali,status,kelas,jurusan)
    VALUES
    ('$user','$buku','$jumlah','$tanggal','$jam','$batas','dipinjam','$kelas','$jurusan')");

    mysqli_query($conn, "UPDATE buku SET stok = stok - $jumlah WHERE id='$buku'");

    echo "<script>alert('Peminjaman berhasil'); location='dashboard.php';</script>";
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="menu">
    <h2>Peminjaman Buku</h2>

    <form method="post">

        <select name="buku" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");
            while ($d = mysqli_fetch_assoc($q)) {
                echo "<option value='$d[id]'>$d[judul] (Stok: $d[stok])</option>";
            }
            ?>
        </select>

        <input type="number" name="jumlah" placeholder="Jumlah Buku" min="1" required>

        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal" required>

        <label>Jam Pinjam</label>
        <input type="time" name="jam" required>

        <input type="text" name="kelas" placeholder="Kelas" required>
        <input type="text" name="jurusan" placeholder="Jurusan" required>

        <label>Lama Pinjam</label>
        <div style="display:flex; gap:10px;">
            <input type="number" name="durasi_jam" placeholder="Jam" min="0" required>
            <input type="number" name="durasi_menit" placeholder="Menit" min="0" max="59" required>
        </div>

        <button name="pinjam">Pinjam Buku</button>
    </form>

    <a href="dashboard.php">Kembali</a>
</div>