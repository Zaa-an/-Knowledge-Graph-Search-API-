<?php
header("Content-Type: application/json; charset=UTF-8");
include 'koneksi.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['nama_entitas']) && isset($data['deskripsi_singkat'])) {
    $google_id = mysqli_real_escape_string($koneksi, $data['google_id']);
    $nama_entitas = mysqli_real_escape_string($koneksi, $data['nama_entitas']);
    $tipe_entitas = mysqli_real_escape_string($koneksi, $data['tipe_entitas']);
    $deskripsi_singkat = mysqli_real_escape_string($koneksi, $data['deskripsi_singkat']);
    $url_sumber = mysqli_real_escape_string($koneksi, $data['url_sumber']);
    $url_gambar = mysqli_real_escape_string($koneksi, $data['url_gambar']);

    $query = "INSERT INTO riwayat_pengetahuan (google_id, nama_entitas, tipe_entitas, deskripsi_singkat, url_sumber, url_gambar) 
              VALUES ('$google_id', '$nama_entitas', '$tipe_entitas', '$deskripsi_singkat', '$url_sumber', '$url_gambar')";
    
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(["success" => true, "message" => "Data berhasil disimpan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan ke database"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data input tidak lengkap"]);
}
?>