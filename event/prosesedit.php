<?php

include "../koneksi.php";

if (isset($_POST['submit'])) {
    $idevent = $_POST['idevent'];
    $kodeevent = $_POST['kodeevent'];
    $jenisevent = $_POST['jenisevent'];
    $namaevent = $_POST['namaevent'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $file_lama = $_POST['file_lama'];

    $ekstensi_diperbolehkan = array('jpg','jpeg','png');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $acak = rand(1,99);
    $nama_unik = $acak.'-'.$nama;

    if (!$file_tmp == ''){
        $d = $_SERVER['DOCUMENT_ROOT'].'/guest/event/file/'.$file_lama;
        unlink("$d");
        $file_baru=$file_tmp;
        move_uploaded_file($file_tmp, 'file/'.$nama_unik);
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){
                $insert = mysqli_query($mysqli, "update event set  
                kodeevent='$kodeevent',
                jenisevent='$jenisevent',
                namaevent='$namaevent',
                lokasi='$lokasi',
                tanggal='$tanggal',
                keterangan='$keterangan',
                nama_file='$nama_unik'

                where idevent='$idevent'");
                if ($insert) {
                    echo"<script>window.location='http://localhost/guest/index.php?event'</script>";
                } else {
                    echo "<script>alert('proses edit gagal');window.history.go(-1);</script>";
                }
            }else{
                echo "<script>alert('ukuran file terlalu besar');window.history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('ekstensi harus JPG');window.history.go(-1);</script>";
        }
        }else{
                    $file_baru = $file_lama;
                    $insert = mysqli_query($mysqli, "update event set  
                    kodeevent='$kodeevent',
                    jenisevent='$jenisevent',
                    namaevent='$namaevent',
                    lokasi='$lokasi',
                    tanggal='$tanggal',
                    keterangan='$keterangan',
                    nama_file='$file_lama'

                    where idevent='$idevent'");
                    if ($insert) {
                        echo"<script>alert('proses edit data berhasil');window.location='http://localhost/guest/index.php?event'</script>";
                    } else {
                        echo "<script>alert('proses edit gagal');window.history.go(-1);</script>";
                    }
                }
}else{
    header('location:http://localhost/guest/index.php?event');
}
?>

