<?php
    include "koneksi.php";
    $idevent = $_GET['idevent'];
    $kueri = mysqli_query($mysqli, "select * from event where idevent='$idevent'");
    $hasil = mysqli_fetch_array($kueri);

    $kueri2 = mysqli_query($mysqli, "select * from tamu where idevent='$idevent'");
    $data = mysqli_fetch_array($kueri2);
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
                                <img src="/guest/event/file/<?php echo $hasil['nama_file'];?>" width="500px" height="550px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="h5 text-gray-900 mb-2">
                                        <strong>
                                        SCAN QR CODE
                                        </strong>
                                    </div>
                                    <div class="text-center">
                                        <style>
                                        #preview{
                                           width:300px;
                                           height:180px;
                                           margin:0px auto;
                                        }
                                        </style>
                                        <video id="preview"></video>
                                    </div>
                                        <hr>
                                        <div class="text-center">
                                            <h2 class="h3 text-gray-900 mb-2s" style="font-family: 'Birthstone', cursive;"><strong><?php echo $hasil['jenisevent']; ?></strong></h2>
                                        </div>
                                        <div class="text-center" style="font-family: 'Birthstone', cursive;">
                                            <h2 class="h3 text-gray-900 mb-2s"><strong><?php echo $hasil['namaevent'];?></strong></h2>
                                        </div>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <a href="index.php?daftarevent2" class="btn btn-sm btn-primary">
                                            <i class="fas fa-backward"></i>
                                             Kembali ke Sistem
                                        </a>
                                        <a href="index.php?scan-manu&idevent=<?php echo $data['idevent']?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-search"></i>
                                             Scan Manual
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <div class="copyright text-center my-auto">
                                            <span>Copyright &copy; Guest Book 2021</span>
                                        </div>
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
    <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
    <script src="vendor/instascan/instascan.min.js"></script>
    <script type="text/javascript">
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        scanner.addListener('scan',function(content){
            window.location.href="http://localhost/guest/index.php?konfirmasi&kodetamu="+content+"&idevent="+"<?php echo $hasil['idevent']; ?>";
            // window.open("http://localhost/guest/index.php?konfirmasi&kodetamu="+content+"&idevent="+"<?php echo $hasil['idevent']; ?>", "_blank");
        });
        Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length>0){
                scanner.start(cameras[0]);
                $('[name="options"]').on('change',function(){
                    if($(this).val()==1){
                        if(cameras[0]!=""){
                            scanner.start(cameras[0]);
                        }else{
                            alert('No Front camera found!');
                        }
                    }else if($(this).val()==2){
                        if(cameras[1]!=""){
                            scanner.start(cameras[1]);
                        }else{
                            alert('No Back camera found!');
                        }
                    }
                });
            }else{
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e){
            console.error(e);
            alert(e);
        });
    </script>

</body>

</html>