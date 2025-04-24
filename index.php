<?php include 'config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengunjung</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #999; padding: 10px; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>


    <h1>Data Pengunjung</h1>
    <a href="tambah.php">+ Tambah Pengunjung</a>
    <a href="detail.php?id=<?= $row['id']; ?>">Detail</a> |

    <a href="export_pdf.php" class="btn btn-danger mb-3">📝 Export ke PDF</a>
<a href="statistik.php" style="background:#04a777; color:#fff; padding:6px 12px; text-decoration:none; border-radius:4px;">📊 Lihat Statistik</a>

    <!-- Form Pencarian dan Filter Tanggal -->
    <form method="GET" action="">
        <input type="text" name="cari" placeholder="Cari nama..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a><br><br>

        <label for="tanggal_mulai">Dari Tanggal:</label>
        <input type="date" name="tanggal_mulai" value="<?= isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '' ?>">

        <label for="tanggal_selesai">Sampai Tanggal:</label>
        <input type="date" name="tanggal_selesai" value="<?= isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : '' ?>">

        <button type="submit">Filter</button>
    </form>

    <!-- Notifikasi hasil pencarian -->
    <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
        <p>Hasil pencarian untuk: <strong><?= htmlspecialchars($_GET['cari']) ?></strong></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Kunjungan</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = "SELECT * FROM pengunjung WHERE 1";  // Awali query dengan WHERE 1 untuk memudahkan pengecekan tambahan filter

        // Filter berdasarkan nama
        if (isset($_GET['cari']) && $_GET['cari'] != '') {
            $cari = mysqli_real_escape_string($conn, $_GET['cari']);
            $query .= " AND nama LIKE '%$cari%'";
        }

        // Filter berdasarkan tanggal
        if (isset($_GET['tanggal_mulai']) && $_GET['tanggal_selesai']) {
            $tanggal_mulai = $_GET['tanggal_mulai'];
            $tanggal_selesai = $_GET['tanggal_selesai'];
            $query .= " AND tanggal_kunjungan BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
        }

        // Jalankan query
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['tanggal_kunjungan']; ?></td>
                <td>
    <a href="detail.php?id=<?= $row['id']; ?>">Detail</a> |
    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
    <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
</td>

            </tr>
        <?php 
            }
        } else {
            echo '<tr><td colspan="5">Data tidak ditemukan.</td></tr>';
        }
        ?>
    </table>
</body>
</html>
