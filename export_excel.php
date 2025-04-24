<?php
include 'config/db.php';

// Header agar file diunduh sebagai Excel
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_pengunjung.xls");

$query = "SELECT * FROM pengunjung ORDER BY tanggal_kunjungan DESC";
$result = mysqli_query($conn, $query);
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['tanggal_kunjungan']) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
