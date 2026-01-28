<?php
include 'config/koneksi.php';

if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $pass = $_POST['password'];


    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO users VALUES(NULL,'$nama','$user','$pass','siswa')");
        echo "<script>alert('Pendaftaran berhasil! Silakan login'); location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="login-box">
        <img src="assets/img/logo.png" class="logo">
        <h2>Daftar Anggota Perpustakaan</h2>

        <form method="post">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button name="daftar">Daftar</button>
        </form>

        <p style="margin-top:10px;">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </p>
    </div>

</body>

</html>