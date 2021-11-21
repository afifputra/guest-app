<?php
    include "koneksi.php";

    date_default_timezone_set('Asia/Jakarta');
    $idevent = $_POST['idevent'];
    $kodetamu = $_POST['kodetamu'];
    $tgl = date('Y-m-d');
    $waktu = date('H:i');

    $kueri = mysqli_query($mysqli, "select * from event where idevent='$idevent'");
    $hasil = mysqli_fetch_array($kueri);

    $kueri2 = mysqli_query($mysqli, "select * from tamu where idevent='$idevent' and kodetamu='$kodetamu'");
    $data = mysqli_fetch_array($kueri2);

    $cek = mysqli_query($mysqli,"select * from tamu where kodetamu='$kodetamu' and idevent='$idevent'");
    if(mysqli_num_rows($cek)>0){
        $insert = mysqli_query($mysqli, "update tamu set
        tglscan = '$tgl', 
        waktu = '$waktu', 
        status = 'Sukses' where kodetamu='$kodetamu' and idevent='$idevent'");
    }else{
        echo "<script>alert('Kode tamu salah. Silahkan masukan ulang kode tamu!');window.history.go(-1);</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Guest Book</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="/guest/event/file/<?php echo $hasil['nama_file'];?>" width="500px" height="550px" >
                                <!-- <span></span> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2s"><strong>Selamat Datang!</strong></h1>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h5 text-gray-900">
                                            Mr. / Mrs. / Ms.
                                        </h1>
                                        <h3 class="h6 text-gray-900" style="font-family:'Balsamiq Sans', cursive;">
                                            <?php 
                                                echo $data['namatamu1'].'<br>';
                                                if ($data['namatamu2'] != '') {
                                                     echo nl2br($data['namatamu2']);
                                                 } 
                                                else{
                                                    echo "";
                                                }
                                            ?>
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <div class="text-l font-weight-bold text-dark text-uppercase">
                                            Table : <?php echo $data['namameja'] ?>
                                        </div>
                                        <div class="text-l font-weight-bold text-dark text-uppercase">
                                            Notes : <?php echo $data['nomorkursi'] ?>
                                        </div>
                                        <div class="text-l font-weight-bold text-dark text-uppercase">
                                            Jumlah orang : <?php echo $data['jmlorang'] ?>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <!-- <a href="scan/download.php?idevent=<?php echo $data['idevent']?>&kodetamu=<?php echo $data['kodetamu']; ?>" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-download"></i>
                                             Registrasi
                                        </a> -->
                                        <a href="#" class="btn btn-sm btn-primary" onclick="MyWindow=window.open('scan/download.php?idevent=<?php echo $data['idevent']?>&kodetamu=<?php echo $data['kodetamu']; ?>','MyWindow','width=300px,height=500px'); return false;">
                                            <i class="fas fa-download"></i>
                                             Registrasi
                                        </a>
                                        <a href="index.php?scan-manu&idevent=<?php echo $data['idevent']?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-backward"></i>
                                             Kembali
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <span class="text-xs">Validate: <?php echo date('d-m-Y', strtotime($data['tglscan'])).' '.date('H:i', strtotime($data['waktu'])); ?></span><br>
                                        <span class="copyright text-xs my-auto">Copyright &copy; Guest Book 2021</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        $.(function(){
            $('a#tes').click(functionName());
            window.history.go(-1);
        });
    </script>

</body>

</html>