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
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengunjung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-300 to-indigo-400 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white/50 dark:bg-gray-800/60 backdrop-blur-md p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Edit Pengunjung</h2>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Nama</label>
                <input type="text" name="nama" value="<?= $data['nama']; ?>" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                    bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Alamat</label>
                <textarea name="alamat" rows="3" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                    bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"><?= $data['alamat']; ?></textarea>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                    bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between pt-4">
                <a href="index.php" class="text-blue-600 dark:text-blue-400 hover:underline">← Kembali</a>
                <button type="submit" name="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                    Update
                </button>
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
