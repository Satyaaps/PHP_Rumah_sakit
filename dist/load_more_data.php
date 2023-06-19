<?php
include "dbconnect.php"; // Sertakan file koneksi MongoDB Anda

$collection = $database->selectCollection("obat"); // Ubah "obat" dengan nama koleksi MongoDB Anda

$limit = 5; // Jumlah data yang akan ditampilkan setiap kali tombol diklik
$skip = isset($_GET['skip']) ? $_GET['skip'] : 0; // Dapatkan nilai skip dari parameter URL

$query = [];
$options = [
    'limit' => $limit,
    'skip' => $skip,
];

$cursor = $collection->find($query, $options);

ob_start(); // Mulai buffering output

foreach ($cursor as $data) {
    // Format data ke dalam baris tabel HTML yang sesuai
    echo '<tr>';
    echo '<td>' . $data['nama_obat'] . '</td>';
    echo '<td>' . $data['stok'] . '</td>';
    echo '<td>' . $data['harga_jual'] . '</td>';
    echo '<td>' . $data['harga_beli'] . '</td>';
    echo '<td>' . $data['jenis_obat'] . '</td>';
    echo '</tr>';
}

$output = ob_get_clean(); // Ambil konten yang telah di-buffering

echo json_encode([
    'output' => $output, // Keluarkan konten HTML sebagai respons JSON
    'hasMore' => $cursor->count() > $limit, // Tentukan apakah masih ada data yang tersisa
]);
?>
