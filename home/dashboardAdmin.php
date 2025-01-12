<?php
include '../koneksi.php';
session_start();

// Get admin name from session
$admin_name = $_SESSION['nama'] ?? 'Admin';

$where = "";
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $where = "WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
}

// Fetch orders
$query = "SELECT * FROM orders $where ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#0a2351] text-white p-6">
            <h1 class="text-2xl font-bold mb-8">Admin</h1>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="dashboardAdmin.php" class="flex items-center space-x-2 bg-blue-900 bg-opacity-50 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span>Order</span>
                </a>
                <a href="produkAdmin.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-blue-900 hover:bg-opacity-50">
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
                <h2 class="text-2xl font-semibold">Order</h2>
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
            <div class="flex justify-between items-center mb-6">
                <div class="flex space-x-2">
                    <input type="date" id="start_date" class="border rounded px-3 py-2" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : '2024-02-01'; ?>">
                    <span class="py-2">to</span>
                    <input type="date" id="end_date" class="border rounded px-3 py-2" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : '2024-03-13'; ?>">
                    <button onclick="filterByDate()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-3 text-left">Kode</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Alamat</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-right">Harga</th>
                            <th class="px-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-t">
                                <td class="px-4 py-3"><?= $row['kode'] ?></td>
                                <td class="px-4 py-3"><?= $row['nama'] ?></td>
                                <td class="px-4 py-3 w-[25rem]"><?= $row['alamat'] ?></td>
                                <td class="px-4 py-3"><?= $row['tanggal'] ?></td>
                                <td class="px-4 py-3 text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-sm
                                    <?php
                                    switch ($row['status']) {
                                        case 'Selesai':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'Pending':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        case 'Dikirim':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                    }
                                    ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function filterByDate() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                window.location.href = `?start_date=${startDate}&end_date=${endDate}`;
            } else {
                alert('Please select both start and end dates');
            }
        }

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