<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fahison Hub</title>
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

    <!-- Pakaian -->
    <main class="px-8 roboto-regular">
      <div class="flex justify-between">
        <h2 class="text-2xl mt-20 mb-6">Koleksi Pakaian</h2>
        <div class="flex">
          <a href="../pages/pakaian.html" class="text-sm mt-20 mb-6">Lihat Semua</a>
          <a href="../pages/pakaian.html" class="px-2 text-sm mt-20 mb-6">
            <img src="/img/icon/arrow.png" alt="Instagram" class="h-6" />
          </a>
        </div>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mx-2 lg:mx-20">
        <!-- Example product -->
        <!-- Repeat for each product -->
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out"
          onclick="window.location.href='/detail/jemy-top.html'">
          <img
            src="/img/pakaian/jemy-top.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jemy Top</span>
          <span class="text-lg mx-3 mb-5">Rp. 90.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/nara-top.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Nara Top</span>
          <span class="text-lg mx-3 mb-5">Rp. 58.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/short-sleeve.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Short Sleeve Cotton Linnear</span>
          <span class="text-lg mx-3 mb-5">Rp. 114.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/jasmine-skirt.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jasmine Skirt</span>
          <span class="text-lg mx-3 mb-5">Rp. 98.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/rok-span.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Rok Span Wanita</span>
          <span class="text-lg mx-3 mb-5">Rp. 114.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/rubi-top-cotton.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Rubi Top Cotton</span>
          <span class="text-lg mx-3 mb-5">Rp. 112.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/kulot-cotton.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Kulot Cotton</span>
          <span class="text-lg mx-3 mb-5">Rp. 87.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/multiway-shirt.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Multi Way Shirt</span>
          <span class="text-lg mx-3 mb-5">Rp. 97.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/wafel-knit-slit-kulot.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Wafel Knit Slit Kulot</span>
          <span class="text-lg mx-3 mb-5">Rp. 89.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/pakaian/jemy-top2.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jemy Top</span>
          <span class="text-lg mx-3 mb-5">Rp. 90.000</span>
        </div>
      </div>

      <!-- Akssoris -->
      <div class="flex justify-between">
        <h2 class="text-2xl mt-20 mb-6">Koleksi Aksesoris</h2>
        <div class="flex">
          <a href="../pages/aksesoris.html" class="text-sm mt-20 mb-6">Lihat Semua</a>
          <a href="../pages/aksesoris.html" class="px-2 text-sm mt-20 mb-6">
            <img src="/img/icon/arrow.png" alt="Instagram" class="h-6" />
          </a>
        </div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mx-2 lg:mx-20">
        <!-- Example product -->
        <!-- Repeat for each product -->
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/cincin-wanita-vintage.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Cincin Wanita Vintage</span>
          <span class="text-lg mx-3 mb-5">Rp. 12.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/anting-wanita-korea.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Anting Wanita Korea, Elegan</span>
          <span class="text-lg mx-3 mb-5">Rp. 25.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/kalung-bintang-resin.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Kalung Bintang Resin</span>
          <span class="text-lg mx-3 mb-5">Rp. 8.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/jepit-rambut-crome.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jepit Rambut Crome</span>
          <span class="text-lg mx-3 mb-5">Rp. 14.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/sabuk-wanita-vintage.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Sabuk Wanita Vintage</span>
          <span class="text-lg mx-3 mb-5">Rp. 23.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out"
          onclick="window.location.href='../detail/set-kalung-mutiara.html'">
          <img
            src="/img/aksesoris/set-kalung-mutiara.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Set Kalung Mutiara</span>
          <span class="text-lg mx-3 mb-5">Rp. 30.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/anting-wanita-kekinian.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Anting Wanita Kekinian</span>
          <span class="text-lg mx-3 mb-5">Rp. 20.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/cincin-bentuk.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jemy Top</span>
          <span class="text-lg mx-3 mb-5">Rp. 90.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/jepitan-rambut-wanita-set.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Jepitan Rambut Wanita Set</span>
          <span class="text-lg mx-3 mb-5">Rp. 10.000</span>
        </div>
        <div
          class="bg-white rounded-lg flex flex-col cursor-pointer hover:brightness-75 hover:shadow-md transition duration-300 ease-in-out">
          <img
            src="/img/aksesoris/cincin-resin-set.png"
            alt="Product Name"
            class="mb-4" />
          <span class="text-lg mx-3">Cincin Resin Set</span>
          <span class="text-lg mx-3 mb-5">Rp. 15.000</span>
        </div>
      </div>
    </main>

    <!-- footer component -->
    <footer-component></footer-component>

    <script>
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