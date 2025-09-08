<?php
include 'config/db.php';

if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query_check = "select id, pas_foto from users where id ='$id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);

        if(!$result){
            header(location : 'users.php');
            exit;
        }
    }

$file = 'file/'; // Ganti dengan path file PDF Anda
$filename = $result->pas_foto; // Ganti dengan nama file yang diinginkan
$filepath = $file.$filename;

echo "<img src='$filepath' height=600>";

?>