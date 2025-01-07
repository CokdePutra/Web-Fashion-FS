<?php
session_start();
include("../koneksi.php");

if (!isset($_SESSION['id_user'])) {
  echo "<script>alert('Anda belum login');window.location.href='../auth/login.php';</script>";
}

$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM tb_user WHERE id_user='$id_user'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $no_telp = $_POST['no_telp'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $profile_picture = $user['profile_picture'];

  if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
      $profile_picture = $target_file;
    } else {
      echo "<script>alert('Gagal mengunggah gambar');</script>";
    }
  }

  $update_query = "UPDATE tb_user SET nama='$nama', email='$email', no_telp='$no_telp', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat', profile_picture='$profile_picture' WHERE id_user='$id_user'";
  $update_result = mysqli_query($koneksi, $update_query);

  if ($update_result) {
    echo "<script>alert('Data berhasil disimpan');window.location.href='../home/homes.php';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan data');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    rel="stylesheet" />
  <style>
    .label-width {
      display: inline-block;
      width: 120px;
    }

    body {
      background-color: #fcf0ec;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    #root {
      flex: 1;
    }
  </style>
</head>

<body>
  <div id="root">
    <!-- navbar component  -->
    <nav-component></nav-component>

    <div class="max-w-3xl mx-auto mt-12 bg-white p-4 md:p-8 shadow-lg">
      <div class="flex flex-col md:flex-row-reverse gap-8 relative">
        <div
          class="flex-shrink-0 flex flex-col items-center md:justify-center md:items-center pb-6 md:pb-0 md:pl-8 md:ml-2 border-b md:border-b-0 md:border-l border-gray-300">
          <img
            class="rounded-full w-36 h-36"
            src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : '../img/aksesoris/jepitan-rambut-wanita-set.png'; ?>"
            alt="Profile Picture" />
          <form method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="profile_picture" class="mt-6 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors" onchange="showSaveButton()" />
        </div>
        <div class="flex-grow">
          <div class="mb-6">
            <h1 class="text-2xl font-bold">Profile Saya</h1>
            <p class="text-gray-600">
              Kelola informasi profil Anda untuk mengontrol, melindungi dan
              mengamankan akun
            </p>
          </div>
          <div class="">
            <h2 class="text-xl font-semibold">User Information</h2>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">Nama:</strong>
              <input
                type="text"
                name="nama"
                value="<?php echo $user['nama']; ?>"
                class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-gray-700 bg-transparent" />
            </p>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">Email:</strong>
              <input
                type="email"
                name="email"
                value="<?php echo $user['email']; ?>"
                class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-gray-700 bg-transparent" />
            </p>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">No Telepon:</strong>
              <input
                type="tel"
                name="no_telp"
                value="<?php echo $user['no_telp']; ?>"
                class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-gray-700 bg-transparent" />
            </p>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">Jenis Kelamin:</strong>
              <span class="inline-flex gap-4">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    name="jenis_kelamin"
                    value="laki-laki"
                    <?php echo ($user['jenis_kelamin'] == 'laki-laki') ? 'checked' : ''; ?>
                    class="text-blue-500 focus:ring-blue-500 h-4 w-4" />
                  <span class="ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    name="jenis_kelamin"
                    value="perempuan"
                    <?php echo ($user['jenis_kelamin'] == 'perempuan') ? 'checked' : ''; ?>
                    class="text-blue-500 focus:ring-blue-500 h-4 w-4" />
                  <span class="ml-2">Perempuan</span>
                </label>
              </span>
            </p>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">Tanggal Lahir:</strong>
              <input
                type="date"
                name="tanggal_lahir"
                value="<?php echo $user['tanggal_lahir']; ?>"
                class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-gray-700 bg-transparent px-0" />
            </p>
            <p class="mt-4 text-gray-700">
              <strong class="label-width">Alamat:</strong>
              <input
                type="text"
                name="alamat"
                value="<?php echo $user['alamat']; ?>"
                class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-gray-700 bg-transparent" />
            </p>
            <div class="mt-8 flex justify-start">
              <button
                type="submit"
                id="saveButton"
                class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors hidden">
                Simpan
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- footer component -->
    <footer-component></footer-component>

    <script src="../component/nav-component.js"></script>
    <script src="../component/footer-component.js"></script>
    <script>
      const initialData = {
        nama: "<?php echo $user['nama']; ?>",
        email: "<?php echo $user['email']; ?>",
        no_telp: "<?php echo $user['no_telp']; ?>",
        jenis_kelamin: "<?php echo $user['jenis_kelamin']; ?>",
        tanggal_lahir: "<?php echo $user['tanggal_lahir']; ?>",
        alamat: "<?php echo $user['alamat']; ?>"
      };

      const formElements = document.querySelectorAll('input[name="nama"], input[name="email"], input[name="no_telp"], input[name="jenis_kelamin"], input[name="tanggal_lahir"], input[name="alamat"]');
      formElements.forEach(element => {
        element.addEventListener('input', checkForChanges);
      });

      function checkForChanges() {
        const currentData = {
          nama: document.querySelector('input[name="nama"]').value,
          email: document.querySelector('input[name="email"]').value,
          no_telp: document.querySelector('input[name="no_telp"]').value,
          jenis_kelamin: document.querySelector('input[name="jenis_kelamin"]:checked').value,
          tanggal_lahir: document.querySelector('input[name="tanggal_lahir"]').value,
          alamat: document.querySelector('input[name="alamat"]').value
        };

        const hasChanges = JSON.stringify(initialData) !== JSON.stringify(currentData);
        document.getElementById('saveButton').classList.toggle('hidden', !hasChanges);
      }

      function showSaveButton() {
        document.getElementById('saveButton').classList.remove('hidden');
      }
    </script>
  </div>
</body>

</html>