<?php
include 'config/db.php';

$periode = $_GET['periode'] ?? 'harian';

if ($periode == 'bulanan') {
    $query = "SELECT DATE_FORMAT(tanggal_kunjungan, '%Y-%m') AS label, COUNT(*) AS total 
              FROM pengunjung 
              GROUP BY label 
              ORDER BY label ASC";
} else {
    $query = "SELECT tanggal_kunjungan AS label, COUNT(*) AS total 
              FROM pengunjung 
              GROUP BY label 
              ORDER BY label ASC";
}

$result = mysqli_query($conn, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
