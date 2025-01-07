<?php
$productName = $_GET['product'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $productName; ?> - Fashion Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <style>
        .playfair-display-custom {
            font-family: "Playfair Display", serif;
            font-weight: 500;
            /* Example weight: Adjust between 400 to 900 as needed */
            font-style: normal;
        }

        .roboto-regular {
            font-family: "Roboto", serif;
            font-weight: 400;
            font-style: normal;
        }

        body {
            background-color: #fcf0ec;
        }

        #root {
            max-width: 2436px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body class="text-gray-700 playfair-display-custom">
    <div id="root">
        <!-- navbar component  -->
        <nav-component></nav-component>

        <!-- Product Detail -->
        <main class="px-8 roboto-regular">
            <h2 class="text-2xl mt-20 mb-6"><?php echo $productName; ?></h2>
            <div class="flex flex-col md:flex-row items-center">
                <img
                    src="../img/pakaian/<?php echo strtolower(str_replace(' ', '-', $productName)); ?>.png"
                    alt="<?php echo $productName; ?>"
                    class="w-full md:w-1/2 mb-4 md:mb-0" />
                <div class="md:ml-8">
                    <p class="text-lg mb-4">Deskripsi produk <?php echo $productName; ?>.</p>
                    <p class="text-lg mb-4">Harga: Rp. 90.000</p>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Tambah ke Keranjang</button>
                </div>
            </div>
        </main>

        <!-- footer component -->
        <footer-component></footer-component>

        <script src="../component/nav-component.js"></script>
        <script src="../component/footer-component.js"></script>
    </div>
</body>

</html>