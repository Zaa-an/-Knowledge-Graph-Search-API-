<?php
// Aktifkan ini untuk melacak isi error jika sewaktu-waktu ada masalah lagi
ini_set('display_errors', 1);
error_reporting(E_ALL);

// SILAKAN SESUAIKAN KEMBALI PARAMETER DI BAWAH INI
$host = "sql100.infinityfree.com"; // <-- GANTI 'sqlXXX' dengan MySQL Host asli dari akun InfinityFree-mu!
$user = "if0_41602457";
$pass = "wFcSTXVeM2X";      // <-- Pastikan password ini adalah password cPanel/MySQL kamu
$db   = "if0_41602457_db_api_google";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode([
        "success" => false, 
        "message" => "Koneksi ke MySQL gagal: " . mysqli_connect_error()
    ]);
    exit();
}

mysqli_set_charset($koneksi, "utf8mb4");
?>