<?php
// Aktifkan pelaporan error agar jika ada masalah, error-nya tertulis jelas di layar (tidak polosan Error 500)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");

// Memastikan file koneksi.php ada sebelum dipanggil
if (!file_exists('koneksi.php')) {
    echo json_encode(["success" => false, "message" => "File koneksi.php tidak ditemukan di server!"]);
    exit();
}

include 'koneksi.php';

// Pastikan variabel $koneksi dari koneksi.php sudah siap
if (!isset($koneksi) || !$koneksi) {
    echo json_encode(["success" => false, "message" => "Variabel koneksi database terputus atau tidak terdefinisi."]);
    exit();
}

$query = "SELECT * FROM riwayat_pengetahuan ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo json_encode([
        "success" => false, 
        "message" => "Query MySQL Error: " . mysqli_error($koneksi)
    ]);
    exit();
}

$list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $list[] = [
        "id" => $row['id'],
        "google_id" => isset($row['google_id']) ? $row['google_id'] : '',
        "nama_entitas" => $row['nama_entitas'],
        "tipe_entitas" => $row['tipe_entitas'],
        "deskripsi_singkat" => $row['deskripsi_singkat'],
        "url_sumber" => $row['url_sumber'],
        "url_gambar" => isset($row['url_gambar']) ? $row['url_gambar'] : null
    ];
}

echo json_encode(["success" => true, "data" => $list]);
?>