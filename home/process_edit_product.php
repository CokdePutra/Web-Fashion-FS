<?php
include '../koneksi.php';
session_start();

// Get admin name from session
$admin_name = $_SESSION['nama'] ?? 'Admin';

// First check for POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for updating product
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $tipe = mysqli_real_escape_string($koneksi, $_POST['tipe']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // Get current product info
    $query = "SELECT src FROM tb_produk WHERE id_produk = $id_produk";
    $result = mysqli_query($koneksi, $query);
    $current_product = mysqli_fetch_assoc($result);
    $src = $current_product['src'];

    // Check if new image is uploaded
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        // Delete old image if it exists
        if (file_exists("../" . $current_product['src'])) {
            unlink("../" . $current_product['src']);
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

        // Set new src path
        $src = "../img/" . strtolower($tipe === "Aksesoris" ? "aksesoris" : "pakaian") . "/" . $new_filename;

        // Upload new image
        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "<script>alert('Failed to upload new image'); window.location='produkAdmin.php';</script>";
            exit;
        }
    }

    // Update database
    $update_query = "UPDATE tb_produk SET 
        nama_produk = '$nama_produk', 
        tipe = '$tipe', 
        deskripsi = '$deskripsi', 
        harga = '$harga', 
        src = '$src' 
        WHERE id_produk = $id_produk";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Produk berhasil diupdate'); window.location='produkAdmin.php';</script>";
    } else {
        echo "<script>alert('Error updating product: " . mysqli_error($koneksi) . "'); window.location='produkAdmin.php';</script>";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produk'])) {
    // Handle displaying the edit form
    $id_produk = mysqli_real_escape_string($koneksi, $_GET['id_produk']);
    $query = "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'";
    $result = mysqli_query($koneksi, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        echo "<script>alert('Produk tidak ditemukan'); window.location='produkAdmin.php';</script>";
        exit;
    }

    $product = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Invalid request'); window.location='produkAdmin.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#0a2351] text-white p-6">
            <h1 class="text-2xl font-bold mb-8">Admin</h1>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="dashboardAdmin.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-blue-900 hover:bg-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span>Order</span>
                </a>
                <a href="produkAdmin.php" class="flex items-center space-x-2 bg-blue-900 bg-opacity-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                    </svg>
                    <span>Produk</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Edit Produk</h2>
                <div class="flex items-center space-x-4">
                    <div>Hallo <?php echo $admin_name; ?>, Selamat Datang</div>
                    <div class="relative">
                        <button id="profileButton" class="w-8 h-8 bg-gray-300 rounded-full hover:bg-gray-400"></button>
                        <!-- Profile Dropdown -->
                        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                            <button onclick="confirmLogout()" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
                <input type="hidden" name="id_produk" value="<?= $product['id_produk'] ?>">
                <div class="mb-4">
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="<?= $product['nama_produk'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="tipe" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="tipe" id="tipe" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Aksesoris" <?= $product['tipe'] == 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                        <option value="Pakaian" <?= $product['tipe'] == 'Pakaian' ? 'selected' : '' ?>>Pakaian</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?= $product['deskripsi'] ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="text" name="harga" id="harga" value="<?= $product['harga'] ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="src" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Profile dropdown functionality
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        function confirmLogout() {
            if (confirm('Apakah Anda yakin untuk logout?')) {
                window.location.href = '../auth/logout.php';
            }
        }
    </script>
</body>

</html>