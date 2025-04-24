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

<h2>Tambah Pengunjung</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" required><br><br>

    <label>Tanggal Kunjungan:</label><br>
    <input type="date" name="tanggal_kunjungan" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>No HP:</label><br>
    <input type="text" name="no_hp"><br><br>

    <label>Catatan Kunjungan:</label><br>
    <textarea name="catatan"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>
<a href="index.php">← Kembali</a>
