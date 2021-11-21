<?php
include "../koneksi.php";

$idtamu = $_GET['idtamu'];
$idevent = $_GET['idevent'];
$delete = mysqli_query($mysqli, "delete from tamu where idtamu='$idtamu' ");
if($delete){
	echo"<script>window.location='http://localhost/guest/index.php?tamu&idevent=".$idevent."';</script>";
}else{
    echo "<script>alert('proses hapus data gagal');window.history.go(-1);</script>";
}
?>
