<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;900&display=swap"
        rel="stylesheet" />
    <style>
        .playfair-display-custom {
            font-family: "Playfair Display", serif;
            font-weight: 500;
            /* Example weight: Adjust between 400 to 900 as needed */
            font-style: normal;
        }
    </style>
</head>

<body
    class="flex items-center justify-center bg-no-repeat bg-cover bg-center bg-fixed h-screen m-0 playfair-display-custom"
    style="background-image: url('../img/bg-login1.png')">
    <div class="h-full w-full flex items-center justify-center" style="background-image: url('../img/bg-login2.png')">
        <div class="max-w-sm w-full text-8xl m-10 text-white">Fashion Hub</div>
    </div>
    <div class="max-w-sm w-full m-10">
        <div class="text-4xl w-[17rem] my-5 text-black">
            Selamat Datang Admin
        </div>
        <form action="proses_login.php" method="POST" class="p-8 rounded-xl shadow-lg" style="background-color: #C9DAF4">
            <input
                type="text"
                placeholder="Email"
                name="email"
                required
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 mb-3" />

            <input
                type="password"
                placeholder="Password"
                name="password"
                required
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 mt-3" />

            <div class="flex justify-between w-full mt-10">
                <button
                    type="submit"
                    class="bg-white text-black py-2 px-4 rounded-xl shadow-lg">
                    <a href="regisAdmin.php">Daftar</a>
                </button>
                <button
                    type="submit"
                    class="bg-white text-black py-2 px-4 rounded-xl shadow-lg">
                    <!-- <a href="/home/homes.html" onclick="alert('Anda Berhasil Masuk');"></a> -->
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>

</html>