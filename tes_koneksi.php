<?php
$conn = mysqli_connect("localhost", "root", "", "pengunjung_db");

if ($conn) {
    echo "✅ Koneksi berhasil!";
} else {
    echo "❌ Gagal koneksi: " . mysqli_connect_error();
}
