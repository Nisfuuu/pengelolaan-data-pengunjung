<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM pengunjung WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengunjung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dark-active {
            background: #1a202c !important;
            color: #f7fafc !important;
        }

        .dark-active .bg-white,
        .dark-active .bg-gradient-to-r,
        .dark-active .bg-opacity-40,
        .dark-active .backdrop-blur-lg {
            background-color: #2d3748 !important;
            color: #f7fafc !important;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-300 to-indigo-400 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white/50 dark:bg-gray-800/60 backdrop-blur-md p-8 rounded-2xl shadow-xl space-y-4 text-gray-800 dark:text-white">
        <h2 class="text-3xl font-semibold text-center mb-6">Detail Pengunjung</h2>

        <div><strong>Nama:</strong> <?= htmlspecialchars($data['nama']); ?></div>
        <div><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']); ?></div>
        <div><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($data['tanggal_kunjungan']); ?></div>
        <div><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></div>
        <div><strong>No HP:</strong> <?= htmlspecialchars($data['no_hp']); ?></div>
        <div><strong>Catatan:</strong> <?= nl2br(htmlspecialchars($data['catatan'])); ?></div>

        <div class="text-center mt-6">
            <a href="index.php" class="inline-block px-6 py-3 bg-[#f75c03] text-white rounded-lg hover:bg-[#d64c00] focus:outline-none focus:ring-2 focus:ring-[#d64c00]">← Kembali ke Data</a>
        </div>
    </div>

</body>
</html>
