<?php include ('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$idevent = $_GET['idevent']; 
$d = mysqli_query($mysqli,"select * from event where idevent='$idevent'");
$data = mysqli_fetch_array($d);
?> 
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tamu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tamu/prosestambah.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Event</label>
                        <div >
                            <select name="idevent" class="form-control" required>
                                <option value="<?php echo $data['idevent']; ?>"><?php echo $data['namaevent']; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kode Tamu</label>
                        <div>
                            <input type="text" name="kodetamu" 
                            <?php
                            $huruf = substr($data['kodeevent'], 0, 2);

                            $kueri = mysqli_query($mysqli, "Select max(kodetamu) as kode from tamu where idevent='$idevent'");
                            $n = mysqli_fetch_array($kueri);
                            $kode = $n['kode'];

                            $urutan = (int)substr($kode, 4, 4);
                            $urutan++;

                            $kodetamu = $huruf.sprintf("%04s",$urutan);
                             echo "value='$kodetamu'"; 
                            ?> class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Tamu 1</label>
                        <div>
                            <input type="text" name="namatamu1" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Tamu 2</label>
                        <div>
                            <textarea type="text" name="namatamu2" value="" class="form-control"></textarea>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label>Jumlah Pax</label>
                        <div>
                            <input type="text" name="jmlorang" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Meja</label>
                        <div>
                            <input type="text" name="namameja" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Kursi</label>
                        <div>
                            <input type="text" name="nomorkursi" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group form-actions">
                            <div>
                                <button type="submit" name="submit" class="btn btn-sm btn-primary">Tambah Tamu</button>
                            </div>
                        </div>
                    </div>      
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Tamu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tamu/import.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $data['idevent']; ?>" id="idevent" name="idevent">
                    <div class="form-group">
                        <div>
                            <input type="file" name="import" required>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <div class="form-group form-actions">
                            <div>
                                <button type="submit" name="upload" value="import" class="btn btn-sm btn-primary">Import</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-10 font-weight-bold text-primary">Daftar Tamu</h6>
            <a class="btn btn-sm btn-primary" data-placement="bottom" title="Tambah Tamu" onclick="$('#tambahModal').modal('show');">Tambah Tamu</a>
            <a class="btn btn-sm btn-success" data-placement="bottom" title="Import Tamu" onclick="$('#importModal').modal('show');">Import dari Excel</a>
            <a class="btn btn-sm btn-success" href="tamu/report.php?idevent=<?php echo $data['idevent']; ?>" target="_blank">Generate Laporan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th width="20px" class="text-center">No</th>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Tamu 1</th>
                        <th class="text-center">Tamu 2</th>
                        <th class="text-center">Pax</th>
                        <th class="text-center">Meja</th>
                        <th class="text-center">Kursi</th>
                        <th class="text-center">Waktu Scan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tampil = mysqli_query($mysqli, "select * from tamu where idevent='$idevent'");
                            $no = 1;
                            while ($hasil = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                        <td width="20px" class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $hasil['kodetamu']; ?></td>
                        <td class="text-center"><?php echo $hasil['namatamu1']; ?></td>
                        <td class="text-center"><?php echo nl2br($hasil['namatamu2']); ?></td>
                        <td class="text-center"><?php echo $hasil['jmlorang']; ?></td>
                        <td class="text-center"><?php echo $hasil['namameja']; ?></td>
                        <td class="text-center"><?php echo $hasil['nomorkursi']; ?></td>
                        <td class="text-center">
                            <?php
                            if($hasil['tglscan'] == ''){
                                echo "<span class='badge badge-warning'>Belum scan</span>";
                            }else{ 
                                echo date('d-m-Y', strtotime($hasil['tglscan'])).' ';
                                echo date('H:i', strtotime($hasil['waktu']));
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($hasil['status'] == 'Sukses'){
                                    echo '<span class="badge badge-success">Sukses</span>';
                                }
                                elseif($hasil['status'] == 'Gagal'){
                                    echo '<span class="badge badge-danger">Gagal</span>';
                                }
                                elseif($hasil['status'] == ''){
                                    echo "<span class='badge badge-warning'>Belum scan</span>";
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-circle btn-sm btn-info" data-placement="bottom" title="Edit Event" onclick="$('#editModal<?php echo $hasil['idtamu'];?>').modal('show');">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data? ');" href="tamu/proseshapus.php?idtamu=<?php echo $hasil['idtamu']; ?>&idevent=<?php echo $data['idevent']; ?>" title="Delete" class="btn btn-circle btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal<?php echo $hasil['idtamu'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" method="post" class="form-bordered" enctype="multipart/form-data">
                    <form action="tamu/prosesedit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $hasil['idtamu']; ?>" name="idtamu">
                            <div class="form-group">
                                <label>Event</label>
                                <div >
                                    <select name="idevent" class="form-control" required>
                                        <option value="<?php echo $data['idevent']; ?>"><?php echo $data['namaevent']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kode Tamu</label>
                                <div>
                                    <input type="text" name="kodetamu" value="<?php echo $hasil['kodetamu']; ?>" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Tamu 1</label>
                                <div>
                                    <input type="text" name="namatamu1" value="<?php echo $hasil['namatamu1']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Tamu 2</label>
                                <div>
                                    <textarea type="text" name="namatamu2" class="form-control"><?php echo $hasil['namatamu2']; ?></textarea>
                                </div>
                            </div>                                    
                            <div class="form-group">
                                <label>Jumlah Pax</label>
                                <div>
                                    <input type="number" name="jmlorang" value="<?php echo $hasil['jmlorang']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Meja</label>
                                <div>
                                    <input type="text" name="namameja" value="<?php echo $hasil['namameja']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Kursi</label>
                                <div>
                                    <input type="text" name="nomorkursi" value="<?php echo $hasil['nomorkursi']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group form-actions">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Edit Tamu</button>
                                    </div>
                                </div>
                            </div>      
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->    
</div>
<!-- End of Main Content -->