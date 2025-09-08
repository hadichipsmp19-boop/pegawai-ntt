<?php
session_start();
include 'config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // amankan id

    $query = "SELECT ktp FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $data   = mysqli_fetch_object($result);

    if (!$data || empty($data->ktp)) {
        echo "File KTP tidak ditemukan.";
        exit;
    }

    $path = "file/";
    $filename = $data->ktp;
    $fullpath = $path . $filename;

    if (file_exists($fullpath)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"" . basename($filename) . "\"");
        header("Content-Length: " . filesize($fullpath));
        readfile($fullpath);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "ID tidak valid.";
}
?>
