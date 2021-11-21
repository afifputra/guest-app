<?php
    
    include "../koneksi.php";

    if (isset($_GET['nama_file'])) {
    $filename    = $_GET['nama_file'];
    $back_dir    =$_SERVER['DOCUMENT_ROOT']."/guest/event/file/";
    $file = $back_dir.$_GET['nama_file'];
     
        if (file_exists($file)) {
            header('Content-Type: image/jpeg');
            readfile($file);
        } 
        else {
            header("location:http://localhost/guest/index.php?event");
        }
    }
?>