<?php
$host = "localhost";
$user = "root";
$pass = ""; // password kosong default XAMPP
$db   = "db_pengunjung"; // ← ganti ke nama database yang benar

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
