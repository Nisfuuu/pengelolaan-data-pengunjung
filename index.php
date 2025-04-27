<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config/db.php';

$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$query = "SELECT * FROM pengunjung WHERE 1";

if (isset($_GET['cari']) && $_GET['cari'] != '') {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    $query .= " AND nama LIKE '%$cari%'";
}

if (!empty($_GET['tanggal_mulai']) && !empty($_GET['tanggal_selesai'])) {
    $tanggal_mulai = $_GET['tanggal_mulai'];
    $tanggal_selesai = $_GET['tanggal_selesai'];
    $query .= " AND tanggal_kunjungan BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
}

$total_query = mysqli_query($conn, $query);
$total_data = mysqli_num_rows($total_query);
$total_halaman = ceil($total_data / $batas);

$query .= " ORDER BY id DESC LIMIT $mulai, $batas";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengunjung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Style untuk dark mode manual -->
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

        .dark-active input,
        .dark-active select {
            background-color: #4a5568 !important;
            color: white !important;
        }

        .dark-active table {
            background-color: #2d3748 !important;
            color: white !important;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 transition-colors duration-500 pt-20">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 w-full bg-gradient-to-r from-green-400 to-blue-500 p-4 flex items-center justify-between z-50">
    <div class="text-white text-xl font-bold">Data Pengunjung</div>

    <!-- Hamburger Button -->
    <button id="menu-toggle" class="md:hidden text-white text-3xl focus:outline-none">
        ☰
    </button>

    <!-- Menu -->
    <div id="menu" class="gap-2 hidden md:flex absolute md:static top-16 right-4 bg-white  md:bg-transparent shadow-md md:shadow-none rounded p-4 md:p-0 w-64 md:w-auto flex-col md:flex-row space-y-2 md:space-y-0">
        <a href="tambah.php" class="block text-center  px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">+ Tambah Pengunjung</a>
        <a href="export_excel.php" class="block text-center  px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Export Excel</a>
        <a href="export_pdf.php" class="block text-center  px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Export PDF</a>
        <a href="statistik.php" class="block text-center  px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Statistik</a>
        <a href="logout.php" class="block text-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Logout</a>
        <button id="dark-mode-toggle" class="block text-center px-4 py-2 bg-black text-white rounded hover:bg-gray-800 w-full md:w-auto">🌜/☀️</button>
    </div>
</nav>



</div>

        <!-- Form Pencarian & Filter -->
  <form method="GET" action="" class="mb-8 bg-gradient-to-r from-teal-400 to-blue-500 bg-opacity-40 backdrop-blur-lg p-6 rounded-xl shadow-xl">
    <div class="flex flex-col items-center justify-center gap-4 md:flex-row">
        <!-- Input Cari -->
        <input type="text" name="cari" placeholder="Cari nama..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>"
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">

        <!-- Tombol Cari & Reset -->
        <div class="flex flex-row gap-2 w-full md:w-auto justify-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Cari</button>
            <a href="index.php" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">Reset</a>
        </div>

        <!-- Input Tanggal Dari & Sampai -->
        <div class="flex flex-row gap-4 w-full md:w-auto justify-center md:mb-8">
            <div class="flex flex-col">
                <label class="text-white mb-1  text-center">Dari</label>
                <input type="date" name="tanggal_mulai" value="<?= $_GET['tanggal_mulai'] ?? '' ?>"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex flex-col">
                <label class="text-white mb-1 text-center">Sampai</label>
                <input type="date" name="tanggal_selesai" value="<?= $_GET['tanggal_selesai'] ?? '' ?>"
                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Tombol Filter -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Filter</button>
    </div>
</form>


        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <!-- Desktop Table -->
            <table class="hidden md:table min-w-full bg-white bg-opacity-40 backdrop-blur-lg border border-gray-300 rounded-xl overflow-hidden shadow-lg">
                <thead class="bg-gradient-to-r from-teal-500 to-purple-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-center">No</th>
                        <th class="py-3 px-6 text-center">Nama</th>
                        <th class="py-3 px-6 text-center">Alamat</th>
                        <th class="py-3 px-6 text-center">Tanggal Kunjungan</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $mulai + 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="border-t">
                        <td class="py-3 px-6 text-center"><?= $no++; ?></td>
                        <td class="py-3 px-6 text-center"><?= $row['nama']; ?></td>
                        <td class="py-3 px-6 text-center"><?= $row['alamat']; ?></td>
                        <td class="py-3 px-6 text-center"><?= $row['tanggal_kunjungan']; ?></td>
                        <td class="py-3 px-6 space-x-2 text-center">
                            <a href="detail.php?id=<?= $row['id']; ?>" class="text-blue-500 hover:underline">Detail</a>
                            <a href="edit.php?id=<?= $row['id']; ?>" class="text-yellow-500 hover:underline">Edit</a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center py-4">Data tidak ditemukan.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4">
                <?php
                $no = $mulai + 1;
                if (mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="bg-white bg-opacity-40 backdrop-blur-lg p-4 rounded-xl shadow-lg">
                    <p><span class="font-semibold">No:</span> <?= $no++; ?></p>
                    <p><span class="font-semibold">Nama:</span> <?= $row['nama']; ?></p>
                    <p><span class="font-semibold">Alamat:</span> <?= $row['alamat']; ?></p>
                    <p><span class="font-semibold">Tanggal:</span> <?= $row['tanggal_kunjungan']; ?></p>
                    <div class="mt-2 space-x-2">
                        <a href="detail.php?id=<?= $row['id']; ?>" class="text-blue-500 hover:underline">Detail</a>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="text-yellow-500 hover:underline">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:underline">Hapus</a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="text-center text-white">Data tidak ditemukan.</div>';
                }
                ?>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 mb-8 flex flex-wrap justify-center gap-2">
            <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                <a href="?halaman=<?= $i; ?><?= isset($_GET['cari']) ? '&cari=' . $_GET['cari'] : ''; ?>"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"><?= $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Script Dark Mode -->
    <script>
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            if (window.innerWidth < 768) {
                menu.classList.add('hidden');
            }
        }
    });

    const darkModeToggle = document.getElementById('dark-mode-toggle');
    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-active');
    });
</script>





</body>
</html>
