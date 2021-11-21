<?php
include "../koneksi.php";

if (isset($_POST['submit'])) {
	$idevent = $_POST['idevent'];
    $kodetamu = $_POST['kodetamu'];
    $namatamu1 = $_POST['namatamu1'];
    $namatamu2 = $_POST['namatamu2'];
    $jmlorang = $_POST['jmlorang'];
    $namameja = $_POST['namameja'];
    $nomorkursi = $_POST['nomorkursi'];

    $insert = mysqli_query($mysqli, "insert into tamu set 
	    kodetamu='$kodetamu',
	    namatamu1='$namatamu1',
	    namatamu2='$namatamu2',
	    jmlorang='$jmlorang',
	    namameja='$namameja',
	    nomorkursi='$nomorkursi',
	    idevent='$idevent'");
	    if ($insert) {
	        echo"<script>window.location='http://localhost/guest/index.php?tamu&idevent=".$idevent."';</script>";
	    } else {
	        echo "<script>alert('proses tambah gagal');window.history.go(-1);</script>";
	    }

}
else {
    header('location:http://localhost/guest/index.php?tamu');
}
?>