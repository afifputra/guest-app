<?php include ('koneksi.php'); 
?>
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Event</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="event/prosestambah.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Kode Event</label>
                            <div>
                                <input type="text" name="kodeevent" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Event</label>
                            <div>
                                <input type="text" name="jenisevent" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Event</label>
                            <div>
                                <input type="text" name="namaevent" value="" class="form-control" required>
                            </div>
                        </div>                                        
                        <div class="form-group">
                            <label>Lokasi</label>
                            <div>
                                <input type="text" name="lokasi" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="form-inline">
                                <input name="tanggal" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <div>
                                <select name="keterangan" class="form-control">
                                    <option value="soon">Soon</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <div >
                                 <input type="file" name="file" required>
                            </div>
                            <div class="alert alert-sm alert-warning">
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                <strong>Note: </strong><br>File harus ukuran 500x550px!<br>Ukuran tidak lebih dari 1MB!
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <div class="form-group form-actions">
                                <div>
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Tambah Event</button>
                                </div>
                            </div>
                        </div>      
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Begin Page Content -->
<div class="container-fluid">
        <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-10 font-weight-bold text-primary">Daftar Event</h6>
            <a class="btn btn-sm btn-primary" data-placement="bottom" title="Tambah Tamu" onclick="$('#tambahModal').modal('show');">Tambah Event</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Jenis Event</th>
                            <th class="text-center">Nama Event</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Ket</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tampil = mysqli_query($mysqli, "select * from event");
                            $no = 1;
                            while ($hasil = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                        <td width="20px" class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $hasil['kodeevent']; ?></td>
                        <td class="text-center"><?php echo $hasil['jenisevent']; ?></td>
                        <td class="text-center"><?php echo $hasil['namaevent']; ?></td>
                        <td class="text-center"><?php echo $hasil['lokasi']; ?></td>
                        <td class="text-center"><?php echo date('d-M-Y', strtotime($hasil['tanggal'])); ?></td>
                        <td class="text-center"><?php
                        if($hasil['keterangan'] == 'soon'){
                            echo '<span class="badge badge-danger">Soon</span>';
                            }
                            else{
                            echo '<span class="badge badge-success">Done</span>';
                            } ?>
                        </td>
                        <td class="text-center">
                            <a href="event/download.php?nama_file=<?php echo $hasil['nama_file'];?>" target="_blank">Lihat</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-circle btn-sm btn-info" data-placement="bottom" title="Edit Event" onclick="$('#editModal<?php echo $hasil['idevent'];?>').modal('show');">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data? ');" href="event/proseshapus.php?idevent=<?php echo $hasil['idevent']; ?>&nama_file=<?php echo $hasil['nama_file']; ?>" title="Delete" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal<?php echo $hasil['idevent'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form action="event/prosesedit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $hasil['idevent']; ?>" name="idevent">
                            <div class="form-group">
                                <label>Kode Event</label>
                                <div>
                                    <input type="text" name="kodeevent" value="<?php echo $hasil['kodeevent']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Event</label>
                                <div>
                                    <input type="text" name="jenisevent" value="<?php echo $hasil['jenisevent']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Event</label>
                                <div>
                                    <input type="text" name="namaevent" value="<?php echo $hasil['namaevent']; ?>" class="form-control" required>
                                </div>
                            </div>                                    
                            <div class="form-group">
                                <label>Lokasi</label>
                                <div>
                                    <input type="text" name="lokasi" value="<?php echo $hasil['lokasi']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div class="form-inline">
                                    <input name="tanggal" type="date" class="form-control" value="<?php echo $hasil['tanggal']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <div>
                                    <select name="keterangan" class="form-control">
                                        <option <?php if($hasil['keterangan']=='soon'){echo "selected"; } ?> value="soon">Soon</option>
                                        <option <?php if($hasil['keterangan']=='done'){echo "selected"; } ?> value="done">Done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <div >
                                    <input type="file" name="file">
                                    <input name="file_lama" type="hidden" id="file_lama" value="<?php echo $hasil['nama_file'] ?>">
                                </div>
                                <span>File sebelumnya: <?php echo $hasil['nama_file']?></span>
                                <div class="alert alert-sm alert-warning">
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Note: </strong><br>File harus ukuran 500x550px!<br>Ukuran tidak lebih dari 1MB!
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group form-actions">
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Edit Event</button>
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