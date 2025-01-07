<?php
include("../koneksi.php");

session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login');window.location.href='../auth/login.php';</script>";
}

$productId = $_GET['product'];
$query = "SELECT * FROM tb_produk WHERE id_produk='$productId'";
$result = mysqli_query($koneksi, $query);
$product = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['id_user'];
    $color = $_POST['color'];
    $quantity = 1;

    $check_cart_query = "SELECT * FROM cart WHERE user_id='$userId' AND product_id='$productId' AND color='$color'";
    $check_cart_result = mysqli_query($koneksi, $check_cart_query);
    if (mysqli_num_rows($check_cart_result) > 0) {
        $update_cart_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id='$userId' AND product_id='$productId' AND color='$color'";
        mysqli_query($koneksi, $update_cart_query);
    } else {
        $insert_cart_query = "INSERT INTO cart (user_id, product_id, quantity, color) VALUES ('$userId', '$productId', '$quantity', '$color')";
        mysqli_query($koneksi, $insert_cart_query);
    }

    echo "<script>alert('Produk berhasil ditambahkan ke keranjang');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $product['nama_produk']; ?> - Fashion Hub</title>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet" />
    <style>
        body {
            background-color: #fcf0ec;
        }

        .tambahKeranjang {
            background-color: #fdd6c9;
            border: #f0440d 2px solid;
        }

        .tambahKeranjang:hover {
            background-color: #fcbba1;
        }
    </style>
</head>

<body>
    <nav-component></nav-component>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img
                            src="<?php echo $product['src']; ?>"
                            alt="<?php echo $product['nama_produk']; ?>"
                            class="w-full h-96 object-cover rounded-lg" />
                    </div>
                    <!-- <div class="grid grid-cols-4 gap-4">
                        <img
                            src="<?php echo $product['src']; ?>"
                            alt="Thumbnail 1"
                            class="w-full h-24 object-cover rounded-lg cursor-pointer" />
                        <img
                            src="<?php echo $product['src']; ?>"
                            alt="Thumbnail 2"
                            class="w-full h-24 object-cover rounded-lg cursor-pointer" />
                        <img
                            src="<?php echo $product['src']; ?>"
                            alt="Thumbnail 3"
                            class="w-full h-24 object-cover rounded-lg cursor-pointer" />
                        <img
                            src="<?php echo $product['src']; ?>"
                            alt="Thumbnail 4"
                            class="w-full h-24 object-cover rounded-lg cursor-pointer" />
                    </div> -->
                </div>

                <!-- Product Info -->
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold"><?php echo $product['nama_produk']; ?></h1>
                    <p class="text-4xl font-semibold text-black-600">Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                    <h3 class="text-lg font-medium mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600">
                        <?php echo $product['deskripsi']; ?>
                    </p>

                    <!-- Color Selection -->
                    <div>
                        <h3 class="text-lg font-medium mb-2">Pilih Warna</h3>
                        <div class="flex items-center gap-4">
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="color"
                                    value="Hitam"
                                    class="hidden peer"
                                    checked
                                    onclick="updateSelectedColor(this)" />
                                <div
                                    class="w-8 h-8 bg-black rounded-full border-2 border-transparent peer-checked:border-blue-500 hover:border-gray-300"></div>
                                <span class="block text-xs text-center mt-1">Hitam</span>
                            </label>
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="color"
                                    value="Cream"
                                    class="hidden peer"
                                    onclick="updateSelectedColor(this)" />
                                <div
                                    class="w-8 h-8 bg-yellow-100 rounded-full border-2 border-transparent peer-checked:border-blue-500 hover:border-gray-300"></div>
                                <span class="block text-xs text-center mt-1">Cream</span>
                            </label>
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="color"
                                    value="Putih"
                                    class="hidden peer"
                                    onclick="updateSelectedColor(this)" />
                                <div
                                    class="w-8 h-8 bg-white rounded-full border-2 border-transparent peer-checked:border-blue-500 hover:border-gray-300"></div>
                                <span class="block text-xs text-center mt-1">Putih</span>
                            </label>
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div>
                        <h3 class="text-lg font-medium mb-2">Pilih Ukuran</h3>
                        <div class="flex gap-4">
                            <button
                                class="px-4 py-2 border rounded-md hover:border-blue-500 size-button"
                                onclick="updateSelectedSize(this)">
                                All Size
                            </button>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <div class="flex gap-4 pt-4">
                        <form method="POST" action="">
                            <input type="hidden" name="color" value="Hitam" id="selectedColor">
                            <button
                                type="submit"
                                class="tambahKeranjang flex-1 text-black py-3 rounded-md flex items-center justify-center gap-2 px-4">
                                <img
                                    src="../img/icon/cart.png"
                                    alt="Cart Icon"
                                    class="w-8 h-8" />
                                Masukan Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer-component></footer-component>
    <script src="../component/nav-component.js"></script>
    <script src="../component/footer-component.js"></script>
    <script>
        function updateSelectedColor(selectedInput) {
            document.getElementById('selectedColor').value = selectedInput.value;
            const labels = document.querySelectorAll("label.cursor-pointer");
            labels.forEach((label) => {
                const input = label.querySelector("input");
                const div = label.querySelector("div");
                if (input === selectedInput) {
                    div.classList.add("border-4", "border-blue-500");
                } else {
                    div.classList.remove("border-4", "border-blue-500");
                }
            });
        }

        function updateSelectedSize(selectedButton) {
            const buttons = document.querySelectorAll(".size-button");
            buttons.forEach((button) => {
                if (button === selectedButton) {
                    button.classList.add("border-4", "border-blue-500");
                } else {
                    button.classList.remove("border-4", "border-blue-500");
                }
            });
        }
    </script>
</body>

</html>