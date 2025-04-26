<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $catatan = $_POST['catatan'];

    $query = "INSERT INTO pengunjung (nama, alamat, tanggal_kunjungan, email, no_hp, catatan)
              VALUES ('$nama', '$alamat', '$tanggal_kunjungan', '$email', '$no_hp', '$catatan')";
    mysqli_query($conn, $query);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengunjung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-300 to-indigo-400 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white/50 dark:bg-gray-800/60 backdrop-blur-md p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Tambah Pengunjung</h2>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Nama</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Alamat</label>
                <input type="text" name="alamat" required class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" required class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">No HP</label>
                <input type="text" name="no_hp" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Catatan Kunjungan</label>
                <textarea name="catatan" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex justify-between">
                <a href="index.php" class="text-blue-600 dark:text-blue-400 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        // Auto-enable dark mode jika sistem mendukung
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
</body>
</html>
