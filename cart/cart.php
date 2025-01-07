<?php
session_start();
include("../koneksi.php");

if (!isset($_SESSION['id_user'])) {
  echo "<script>alert('Anda belum login');window.location.href='../auth/login.php';</script>";
}

$userId = $_SESSION['id_user'];
$query = "SELECT cart.*, tb_produk.nama_produk, tb_produk.src, tb_produk.harga FROM cart JOIN tb_produk ON cart.product_id = tb_produk.id_produk WHERE cart.user_id='$userId'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart</title>
  <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    rel="stylesheet" />
  <style>
    body {
      background-color: #fcf0ec;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    #root {
      flex: 1;
    }

    .checkout {
      background-color: #f0440d;
    }

    .checkout:hover {
      background-color: #ea5200;
    }

    .hapus {
      background-color: #ffe2c0;
      border: #ea5200 2px solid;
    }

    .hapus:hover {
      background-color: #fdd6c9;
    }
  </style>
</head>

<body>
  <nav-component></nav-component>
  <div
    id="root"
    class="container mx-auto p-6 px-16 bg-white shadow-md rounded-lg">
    <div id="cart-items-container">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="md:flex items-center justify-between border-b pb-4 mb-4 cart-item" data-product-id="<?php echo $row['product_id']; ?>">
          <input type="checkbox" class="mr-4" onchange="updateTotalPrice()" />
          <img src="<?php echo $row['src']; ?>" alt="Item Image" class="w-24 h-24 object-cover rounded-lg" />
          <div class="">
            <h3 class="text-lg font-semibold text-left w-40"><?php echo $row['nama_produk']; ?></h3>
            <p>Warna: <span class="item-color"><?php echo $row['color']; ?></span></p>
          </div>
          <div class="flex md:items-center md:justify-center m-3">
            <button class="px-2 py-1 bg-gray-200 rounded-md" onclick="updateQuantity(this, -1)">-</button>
            <span class="mx-3 item-quantity"><?php echo $row['quantity']; ?></span>
            <button class="px-2 py-1 bg-gray-200 rounded-md" onclick="updateQuantity(this, 1)">+</button>
          </div>
          <span class="text-lg font-semibold w-32 item-price" data-price="<?php echo $row['harga']; ?>">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></span>
          <button class="hapus px-4 py-2 m-3 text-black rounded-xl" onclick="confirmRemoveItem(this)">Hapus</button>
        </div>
      <?php } ?>
    </div>
    <div class="flex justify-end items-center mt-4 gap-4">
      <span class="text-xl font-semibold">Total (<span id="total-items">0</span> Produk):
        <span id="total-price">Rp 0</span></span>
      <button
        class="checkout px-6 py-2 text-white rounded-xl"
        onclick="proceedToCheckout()">
        Checkout
      </button>
    </div>
  </div>
  <footer-component></footer-component>
  <script>
    function updateQuantity(button, change) {
      const quantitySpan = button.parentElement.querySelector(".item-quantity");
      let currentQuantity = parseInt(quantitySpan.textContent);
      currentQuantity += change;
      if (currentQuantity < 1) currentQuantity = 1;
      quantitySpan.textContent = currentQuantity;
      updateTotalPrice();

      const productId = button.closest(".cart-item").dataset.productId;
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "update_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(`product_id=${productId}&quantity=${currentQuantity}`);
    }

    function confirmRemoveItem(button) {
      if (confirm("Anda yakin untuk menghapus produk ini?")) {
        removeItem(button);
      }
    }

    function removeItem(button) {
      const cartItem = button.closest(".cart-item");
      const productId = cartItem.dataset.productId;
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "remove_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(`product_id=${productId}`);
      cartItem.remove();
      updateTotalPrice();
    }

    function updateTotalPrice() {
      const cartItems = document.querySelectorAll(".cart-item");
      let totalPrice = 0;
      let totalItems = 0;
      cartItems.forEach((item) => {
        const checkbox = item.querySelector("input[type='checkbox']");
        if (checkbox.checked) {
          const quantity = parseInt(item.querySelector(".item-quantity").textContent);
          const price = parseInt(item.querySelector(".item-price").dataset.price);
          totalPrice += quantity * price;
          totalItems += quantity;
        }
      });
      document.getElementById("total-price").textContent = formatPrice(totalPrice);
      document.getElementById("total-items").textContent = totalItems;
    }

    function formatPrice(price) {
      return new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
          minimumFractionDigits: 0,
        })
        .format(price)
        .replace("IDR", "Rp ");
    }

    function proceedToCheckout() {
      const cartItems = [];
      document.querySelectorAll(".cart-item").forEach((item) => {
        const image = item.querySelector("img").src;
        const name = item.querySelector("h3").textContent;
        const color = item.querySelector(".item-color").textContent;
        const price = parseInt(item.querySelector(".item-price").dataset.price);
        const quantity = parseInt(item.querySelector(".item-quantity").textContent);
        cartItems.push({
          image,
          name,
          color,
          price,
          quantity
        });
      });
      localStorage.setItem("cartItems", JSON.stringify(cartItems));
      window.location.href = "../cart/pembayaran.html";
    }

    document.addEventListener("DOMContentLoaded", () => {
      updateTotalPrice();
    });
  </script>
  <script src="../component/nav-component.js"></script>
  <script src="../component/footer-component.js"></script>
</body>

</html>