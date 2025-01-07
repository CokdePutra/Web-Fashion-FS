<?php
include("../koneksi.php");

$query = "SELECT * FROM tb_produk WHERE tipe='aksesoris'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fahison Hub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap"
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

    <!-- Akssoris -->
    <main class="px-8 roboto-regular">
      <h2 class="text-2xl mt-20 mb-6">Koleksi Aksesoris</h2>
      <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mx-2 lg:mx-20">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div
            class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out"
            onclick="goToDetail('<?php echo $row['id_produk']; ?>')">
            <img
              src="<?php echo $row['src']; ?>"
              alt="<?php echo $row['nama_produk']; ?>"
              class="mb-4" />
            <span class="text-lg mx-3"><?php echo $row['nama_produk']; ?></span>
            <span class="text-lg mx-3 mb-5">Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></span>
          </div>
        <?php } ?>
      </div>
    </main>

    <!-- footer component -->
    <footer-component></footer-component>

    <script>
      // Function to generate detail page URL based on product ID
      function goToDetail(productId) {
        window.location.href = `../detail/detail-template.php?product=${productId}`;
      }

      // Get references to menu button and dropdown menu
      const menuBtn = document.getElementById("menu-btn");
      const dropdown = document.getElementById("menu");

      // Toggle dropdown visibility when menu button is clicked
      menuBtn.addEventListener("click", function() {
        dropdown.classList.toggle("hidden");
      });

      // Close dropdown when clicking outside of it
      window.addEventListener("click", function(e) {
        if (
          !menuBtn.contains(e.target) &&
          !dropdown.contains(e.target) &&
          !dropdown.classList.contains("hidden")
        ) {
          dropdown.classList.add("hidden");
        }
      });
    </script>
    <script src="../component/nav-component.js"></script>
    <script src="../component/footer-component.js"></script>
  </div>
</body>

</html>