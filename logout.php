<?php
    include ('koneksi.php');
    session_start();
    $id = $_SESSION['id'];
        session_destroy();
        // header("location:index.php");
        echo"<script>window.location='http://localhost/guest/index.php'</script>";