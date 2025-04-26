<?php
require_once __DIR__ . '/vendor/autoload.php';
use Endroid\QrCode\Builder\Builder;

$id = $_GET['id'] ?? 1; // ID pengunjung

$result = Builder::create()
    ->data("http://localhost/semester2/pengelolaan-data-pengunjung/checkin.php?id=$id")
    ->size(300)
    ->build();

header('Content-Type: '.$result->getMimeType());
echo $result->getString();
