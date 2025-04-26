<?php
include 'config/db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pengunjung WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal_kunjungan'];

    mysqli_query($conn, "UPDATE pengunjung SET nama='$nama', alamat='$alamat', tanggal_kunjungan='$tanggal' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengunjung</title>
    <!-- Tambahkan link ke CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-800 flex items-center justify-center p-4">

    <!-- Container Form -->
    <div class="w-full max-w-lg bg-white dark:bg-gray-900 p-8 rounded-xl shadow-xl space-y-6">

        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white">Edit Pengunjung</h2>

        <!-- Formulir untuk mengedit pengunjung -->
        <form method="post" action="">
            <div class="space-y-4">
                <!-- Input Nama -->
                <div>
                    <label for="nama" class="text-lg text-gray-700 dark:text-gray-300">Nama:</label>
                    <input type="text" name="nama" id="nama" value="<?= $data['nama']; ?>" required class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input Alamat -->
                <div>
                    <label for="alamat" class="text-lg text-gray-700 dark:text-gray-300">Alamat:</label>
                    <textarea name="alamat" id="alamat" required class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $data['alamat']; ?></textarea>
                </div>

                <!-- Input Tanggal Kunjungan -->
                <div>
                    <label for="tanggal_kunjungan" class="text-lg text-gray-700 dark:text-gray-300">Tanggal Kunjungan:</label>
                    <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tombol Update dan Batal -->
                <div class="flex justify-between items-center">
                    <button type="submit" name="submit" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
                    <a href="index.php" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Batal</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
