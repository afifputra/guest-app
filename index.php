<?php 
include 'koneksi.php';
// mengaktifkan session
session_start();
?>

<?php
    if($_SESSION && isset($_GET["home"])){
    	include "header.php";
        include "home.php";
        include "footer.php";
    }
    else if($_SESSION && isset($_GET["login"])){
        include "header.php";
        include "home.php";
        include "footer.php"; 
    }
    else if($_SESSION && isset($_GET["event"])){
        include "header.php";
        include "event/event.php";
        include "footer.php"; 
    }
    else if($_SESSION && isset($_GET["daftarevent"])){
        include "header.php";
        include "tamu/daftarevent.php";
        include "footer.php"; 
    }
    else if($_SESSION && isset($_GET["tamu"])){
        include "header.php";
        include "tamu/tamu.php";
        include "footer.php"; 
    }
    else if($_SESSION && isset($_GET["daftarevent2"])){
        include "header.php";
        include "scan/daftarevent.php";
        include "footer.php";
    }
    else if($_SESSION && isset($_GET["scan"])){
        include "scan/scan.php";
    }
    else if($_SESSION && isset($_GET["scan-manu"])){
        include "scan/scan-manu.php";
    }
    else if($_SESSION && isset($_GET["konfirmasi"])){
        include "scan/konfirmasi.php";
    }
    else if($_SESSION && isset($_GET["konfirmasi-manu"])){
        include "scan/konfirmasi-manu.php";
    }
    else if(isset($_GET["login"])){
        include "login.php";
    }
    else if($_SESSION){
        include "header.php";
        include "home.php";
        include "footer.php";
    }
    else{
        include "login.php";
    }
?>