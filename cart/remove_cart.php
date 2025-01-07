<?php
include("../koneksi.php");

session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login');window.location.href='../auth/login.php';</script>";
}

$userId = $_SESSION['id_user'];
$idCart = $_POST['id_cart'];

$delete_cart_query = "DELETE FROM cart WHERE user_id='$userId' AND id_cart='$idCart'";
mysqli_query($koneksi, $delete_cart_query);
