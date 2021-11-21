<?php
include "../koneksi.php";

$idevent = $_GET['idevent'];
$nama_file = $_GET['nama_file'];
	unlink($_SERVER['DOCUMENT_ROOT'].'/guest/event/file/'.$nama_file);
$delete = mysqli_query($mysqli, "delete from event where idevent='$idevent' ");
$tamdel = mysqli_query($mysqli, "delete from tamu where idevent='$idevent'");
if($delete && $tamdel){
	echo"<script>window.location='http://localhost/guest/index.php?event'</script>";
}else{
    echo "<script>alert('proses hapus data gagal');window.history.go(-1);</script>";
}

?>
