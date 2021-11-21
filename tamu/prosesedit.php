<?php
include "../koneksi.php";

if (isset($_POST['submit'])) {
	$idtamu = $_POST['idtamu'];
	$idevent = $_POST['idevent'];
    $kodetamu = $_POST['kodetamu'];
    $namatamu1 = $_POST['namatamu1'];
    $namatamu2 = $_POST['namatamu2'];
    $jmlorang = $_POST['jmlorang'];
    $namameja = $_POST['namameja'];
    $nomorkursi = $_POST['nomorkursi'];

    $insert = mysqli_query($mysqli, "update tamu set  
        kodetamu='$kodetamu',
	    namatamu1='$namatamu1',
	    namatamu2='$namatamu2',
	    jmlorang='$jmlorang',
	    namameja='$namameja',
	    nomorkursi='$nomorkursi',
	    idevent='$idevent'

        where idtamu='$idtamu'");
        if ($insert) {
            echo"<script>window.location='http://localhost/guest/index.php?tamu&idevent=".$idevent."';</script>";
        } else {
            echo "<script>alert('proses edit gagal');window.history.go(-1);</script>";
        }
}
else{
	header('location:http://localhost/guest/index.php?tamu');
}
?>