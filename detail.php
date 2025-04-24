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

<h2>Detail Pengunjung</h2>
<p><strong>Nama:</strong> <?= $data['nama']; ?></p>
<p><strong>Alamat:</strong> <?= $data['alamat']; ?></p>
<p><strong>Tanggal Kunjungan:</strong> <?= $data['tanggal_kunjungan']; ?></p>
<p><strong>Email:</strong> <?= $data['email']; ?></p>
<p><strong>No HP:</strong> <?= $data['no_hp']; ?></p>
<p><strong>Catatan:</strong> <?= nl2br($data['catatan']); ?></p>

<a href="index.php">← Kembali ke Data</a>
