<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");
    $d = mysqli_fetch_assoc($q);

    if ($d && $p == $d['password']) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $d['id'];
        $_SESSION['role'] = $d['role'];
        $_SESSION['nama'] = $d['nama'];

        if ($d['role'] == "admin") {
            header("location:admin/dashboard.php");
        } else {
            header("location:siswa/dashboard.php");
        }
    } else {
        echo "<script>alert('Login gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="login-box">
        <img src="assets/img/logo.png" class="logo">
        <h2>Login Perpustakaan</h2>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
        </form>

        <p style="margin-top:10px;">
            Belum punya akun?
            <a href="register.php">Daftar di sini</a>
        </p>
    </div>

</body>

</html>