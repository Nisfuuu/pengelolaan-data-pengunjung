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
<html>
<head>
    <title>Edit Pengunjung</title>
</head>
<body>
    <h1>Edit Pengunjung</h1>
    <form method="post" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required><?= $data['alamat']; ?></textarea><br><br>

        <label>Tanggal Kunjungan:</label><br>
        <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan']; ?>" required><br><br>

        <button type="submit" name="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
