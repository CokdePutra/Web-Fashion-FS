<?php

include "../koneksi.php";

session_start();
// if (!isset($_SESSION['username'])) {
//     echo "<script>alert('anda belum login');location.href='login.php'</script>";
// }

$name = $_POST['nama'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$password = $_POST['password'];

$pws_encript = password_hash($password, PASSWORD_DEFAULT);

$hasil_user = mysqli_query($koneksi, "SELECT * FROM tb_user  WHERE email='$email'");
$cek_row_user = mysqli_num_rows($hasil_user);

if ($cek_row_user > 0) {
    echo "<script>
    alert('Maaf Username sudah di Registrasi, Silahkan ganti Username ');
    location.href='regis.php';
    </script>";
} else {
    $query = "INSERT INTO tb_user VALUE ('','$name', '$email', '$pws_encript', '$no_telp','','','','user')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "<script>
    alert('Register failed!');
    location.href='regis.php';
    </script>";
    } else {
        echo "<script>
    alert('Anda Berhasil Registrasi, Silahkan login dengan akun yang sudah terdaftar ');
    location.href='login.php';
    </script>";
    }
}
