<?php
include("../koneksi.php");

session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login');window.location.href='../auth/login.php';</script>";
}

$userId = $_SESSION['id_user'];
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];

$update_cart_query = "UPDATE cart SET quantity='$quantity' WHERE user_id='$userId' AND product_id='$productId'";
mysqli_query($koneksi, $update_cart_query);
