<?php
session_start();
include("../koneksi.php");

$email = $_POST['email'];
$password = $_POST['password'];

$hasil_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$email'");
$cek_user = mysqli_num_rows($hasil_user);
$row = mysqli_fetch_assoc($hasil_user);
$level_user = $row['level_user'];

if ($cek_user > 0 && password_verify($password, $row['password'])) {
    if ($level_user == "admin") {
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['level_user'] = $row['level_user'];

        header("location:../home/dashboardAdmin.php");
    } elseif ($level_user == "user") {
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['level_user'] = $row['level_user'];

        header("location:../home/homes.php");
    }
} else {
    echo "<script>alert('Maaf Password atau Username Anda salah');location.href='login.php'</script>";
}
