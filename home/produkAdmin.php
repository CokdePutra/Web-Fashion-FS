<?php
include '../koneksi.php';
session_start();

// Get admin name from session
$admin_name = $_SESSION['nama'] ?? 'Admin';

// Fetch products
$query = "SELECT * FROM tb_produk ORDER BY id_produk ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Produk</title>
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
                <h2 class="text-2xl font-semibold">Produk</h2>
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

            <!-- Action Bar -->
            <div class="mb-6">
                <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Tambah Produk
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-3 text-left">Kode</th>
                            <th class="px-4 py-3 text-left">Nama Produk</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-right">Harga</th>
                            <th class="px-4 py-3 text-center">Gambar</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3">#<?= $row['id_produk'] ?></td>
                                <td class="px-4 py-3"><?= $row['nama_produk'] ?></td>
                                <td class="px-4 py-3"><?= ucfirst($row['tipe']) ?></td>
                                <td class="px-4 py-3"><?= $row['deskripsi'] ?></td>
                                <td class="px-4 py-3 text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td class="px-4 py-3 text-center">
                                    <img src="<?= $row['src'] ?>" alt="<?= $row['nama_produk'] ?>" class="w-16 h-16 object-cover mx-auto rounded">
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="window.location.href='process_edit_product.php?id_produk=<?= $row['id_produk'] ?>'"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </button>
                                    <button onclick="openDeleteModal(<?= $row['id_produk'] ?>)"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>
            <form action="process_add_product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Kategori</label>
                    <select name="tipe" class="w-full border rounded px-3 py-2" required>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Harga</label>
                    <input type="number" name="harga" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Gambar</label>
                    <input type="file" name="gambar" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addModal')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Edit Produk</h2>
            <form action="process_edit_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" id="edit_id_produk">
                <div class="mb-4">
                    <label class="block mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" id="edit_nama_produk" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Kategori</label>
                    <select name="tipe" id="edit_tipe" class="w-full border rounded px-3 py-2" required>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Harga</label>
                    <input type="number" name="harga" id="edit_harga" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Gambar</label>
                    <input type="file" name="gambar">
                    <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</small>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editModal')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus produk ini?</p>
            <div class="flex justify-end mt-6">
                <button onclick="closeModal('deleteModal')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                <button onclick="deleteProduct()" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
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

        let deleteProductId = null;

        function openAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function openEditModal(product) {
            document.getElementById('edit_id_produk').value = product.id_produk;
            document.getElementById('edit_nama_produk').value = product.nama_produk;
            document.getElementById('edit_tipe').value = product.tipe;
            document.getElementById('edit_deskripsi').value = product.deskripsi;
            document.getElementById('edit_harga').value = product.harga;
            document.getElementById('editModal').style.display = 'flex';
        }

        function openDeleteModal(id) {
            deleteProductId = id;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function deleteProduct() {
            if (deleteProductId) {
                window.location.href = 'process_delete_product.php?id=' + deleteProductId;
            }
        }
    </script>
</body>

</html>