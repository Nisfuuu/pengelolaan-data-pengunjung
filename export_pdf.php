<?php
require_once('vendor/autoload.php'); // pastikan sudah ada TCPDF

include 'config/db.php';

$query = "SELECT * FROM pengunjung";
$result = mysqli_query($conn, $query);

// Buat instance TCPDF
$pdf = new TCPDF();

// Set beberapa informasi PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pengelolaan Data Pengunjung');
$pdf->SetTitle('Laporan Data Pengunjung');
$pdf->SetSubject('Export PDF Data Pengunjung');

// Add page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Judul halaman
$pdf->Cell(0, 10, 'Laporan Data Pengunjung', 0, 1, 'C');

// Add table headers
$pdf->Ln(10); // space between title and table
$pdf->Cell(20, 10, 'No', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(60, 10, 'Alamat', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal Kunjungan', 1, 1, 'C');

// Add data rows
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(20, 10, $no++, 1, 0, 'C');
    $pdf->Cell(60, 10, $row['nama'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['alamat'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['tanggal_kunjungan'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('laporan_pengunjung.pdf', 'I'); // 'I' means inline display
?>
