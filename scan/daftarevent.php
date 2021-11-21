<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-10 font-weight-bold text-primary">Daftar Event</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th class="text-center">Kode Event</th>
                            <th class="text-center">Jenis Event</th>
                            <th class="text-center">Nama Event</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                            include ('koneksi.php');
                            $tampil = mysqli_query($mysqli, "select * from event");
                            $no = 1;
                            while ($hasil = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                            <td width="20px" class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $hasil['kodeevent']; ?></td>
                            <td class="text-center"><?php echo $hasil['jenisevent']; ?></td>
                            <td class="text-center"><?php echo $hasil['namaevent']; ?></td>
                            <td class="text-center"><?php echo date('d F Y', strtotime($hasil['tanggal'])); ?></td>
                            <td class="text-center">
                                <a href="index.php?scan&idevent=<?php echo $hasil['idevent']?>" class="btn btn-sm btn-danger btn-icon-split" target="_blank">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <span class="text">Scan Now</span>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->