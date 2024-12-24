<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function format_rupiah($angka) {
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

$no = 1;
ob_clean();
ob_flush();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Transaksi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nik</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Status</th>
                    <th scope="col">Denda</th>
                </tr>
            </thead>
            <tbody>';

// Sample data (dapat diganti dengan data dari model Anda)
$models = 0;

$no = 1;
foreach ($model['laporan'] as $laporan) {
    $models = $models + $laporan['denda'];
    $html .= '<tr>';
    $html .= '<td>' . $no++ . '</td>';
    $html .= '<td>' . $laporan['nama_anggota'] . '</td>';
    $html .= '<td>' . $laporan['alamat_anggota'] . '</td>';
    $html .= '<td>' . $laporan['nik'] . '</td>';
    $html .= '<td>' . $laporan['nama_buku'] . '</td>';
    $html .= '<td>' . $laporan['status_peminjaman']. '</td>';
    $html .= '<td>' . format_rupiah($laporan['denda']) . '</td>';
    $html .= '</tr>';
}

$html .= '
            </tbody>
        </table>
        <h1>Total Pendapatan: ' . format_rupiah($models) . '</h1>
    </div>
</body>
</html>
';

// Memuat konten HTML ke dalam Dompdf
$dompdf->loadHtml($html);

// (Optional) Pengaturan PDF
$dompdf->setPaper('A4', 'portrait'); // Ukuran kertas dan orientasi (portrait atau landscape)

// Render PDF (mengubah HTML menjadi PDF)
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("laporan.pdf", ["Attachment" => 0]);
?>