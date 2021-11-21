<!-- import excel ke mysql -->

<?php 
// menghubungkan dengan koneksi
include "../koneksi.php";
// menghubungkan dengan library excel reader
include "../excel_reader2.php";
?>

<?php
$idevent = $_POST['idevent'];
// upload file xls
$target = basename($_FILES['import']['name']) ;
move_uploaded_file($_FILES['import']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['import']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['import']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $kodetamu       = $data->val($i, 1);
    $namatamu1      = $data->val($i, 2);
    $namatamu2      = $data->val($i, 3);
    $jmlorang       = $data->val($i, 4);
    $namameja       = $data->val($i, 5);
    $nomorkursi     = $data->val($i, 6);
    

    if($kodetamu != "" && $namatamu1 != "" && $jmlorang != "" && $namameja != "" && $nomorkursi != ""){
        // input data ke database (table data_pegawai)
        mysqli_query($mysqli,"insert into tamu set 
         kodetamu       = '$kodetamu', 
         namatamu1      = '$namatamu1', 
         namatamu2      = '$namatamu2',
         jmlorang       = '$jmlorang',
         namameja       = '$namameja',
         nomorkursi     = '$nomorkursi',
         idevent        = '$idevent'
         ");
        $berhasil++;
    }
}

//hapus kembali file .xls yang di upload tadi
unlink($_FILES['import']['name']);

// alihkan halaman ke index.php
echo"<script>window.location='http://localhost/guest/index.php?tamu&idevent=".$idevent."';</script>";
?>