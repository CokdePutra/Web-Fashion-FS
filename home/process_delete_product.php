<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Get product info before deleting
    $query = "SELECT src, tipe FROM tb_produk WHERE id_produk = $id_produk";
    $result = mysqli_query($koneksi, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        // Delete the image file
        $image_path = "../" . $product['src'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete from database
        $delete_query = "DELETE FROM tb_produk WHERE id_produk = $id_produk";
        if (mysqli_query($koneksi, $delete_query)) {
            echo "<script>alert('Produk berhasil dihapus'); window.location='produkAdmin.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus produk'); window.location='produkAdmin.php';</script>";
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan'); window.location='produkAdmin.php';</script>";
    }
} else {
    echo "<script>alert('ID Produk tidak valid'); window.location='produkAdmin.php';</script>";
}
