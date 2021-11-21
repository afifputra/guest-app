<?php
    session_start();
    include "koneksi.php";

    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);

    $cek = mysqli_query($mysqli,"select * from user where username='$username' and password='$password' ");
    if(mysqli_num_rows($cek)>0){
        $data = mysqli_fetch_array($cek);
        $_SESSION['username'] = $data['username'];
        $_SESSION['id'] = $data['id'];
        echo "<script>window.location.href='index.php?home'</script>";
    }else{
        echo "<script>alert('periksa kembali username dan password yang anda masukan');window.history.go(-1);</script>";
    }
?>