<?php
session_start();
include("../koneksi.php");

if (!isset($_SESSION['id_user'])) {
    echo "Unauthorized";
    exit;
}

$id_cart = $_POST['id_cart'];
$quantity = $_POST['quantity'];

$query = "UPDATE cart SET quantity='$quantity' WHERE id_cart='$id_cart'";
mysqli_query($koneksi, $query);
