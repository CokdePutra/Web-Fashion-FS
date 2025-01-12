<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $tipe = mysqli_real_escape_string($koneksi, $_POST['tipe']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // Check if file was uploaded
    if (!isset($_FILES["gambar"]) || $_FILES["gambar"]["error"] != 0) {
        echo "<script>alert('Error: File upload failed'); window.location='produkAdmin.php';</script>";
        exit;
    }

    // Set directory based on product type
    $base_dir = "../img/";
    $target_dir = $tipe === "Aksesoris" ? $base_dir . "aksesoris/" : $base_dir . "pakaian/";

    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            echo "<script>alert('Failed to create upload directory'); window.location='produkAdmin.php';</script>";
            exit;
        }
    }

    // Validate file type
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed'); window.location='produkAdmin.php';</script>";
        exit;
    }

    // Generate unique filename
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;

    // Change this line - fix the image path format
    $src = "../img/" . strtolower($tipe === "Aksesoris" ? "aksesoris" : "pakaian") . "/" . $new_filename;

    // Try to upload file
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO tb_produk (nama_produk, tipe, deskripsi, harga, src) 
                 VALUES ('$nama_produk', '$tipe', '$deskripsi', '$harga', '$src')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Produk berhasil ditambahkan'); window.location='produkAdmin.php';</script>";
        } else {
            unlink($target_file); // Delete uploaded file if query fails
            echo "<script>alert('Error database: " . mysqli_error($koneksi) . "'); window.location='produkAdmin.php';</script>";
        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file'); window.location='produkAdmin.php';</script>";
    }
}
