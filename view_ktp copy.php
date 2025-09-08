<?php
session_start();
include 'koneksi.php'; // pastikan koneksi ada

if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    $query_check = "SELECT id, ktp FROM users WHERE id ='$id'";
    $run_query_check = mysqli_query($conn, $query_check);
    $result = mysqli_fetch_object($run_query_check);

    if (!$result) {
        header("Location: informasi-pegawai.php");
        exit;
    }
}

$path = 'file/';
$filename = $result->ktp;
$fullpath = $path . $filename;

if (!empty($filename) && file_exists($fullpath)) {
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"" . basename($filename) . "\"");
    header("Content-Length: " . filesize($fullpath));
    readfile($fullpath);
    exit;
} else {
    echo "File tidak ditemukan.";
}
?>
