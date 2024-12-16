<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Surat Keluar</h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('s_keluar/tambah'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-primary">Nomor</label>
                                    <input type="text" name="no" class="form-control no" placeholder="Nomor" required>
                                    <div class="invalid-feedback errorno"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Perihal</label>
                                    <input type="text" name="perihal" class="form-control perihal" placeholder="Perihal" required>
                                    <div class="invalid-feedback errorperihal"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal" required>
                                    <div class="invalid-feedback errortanggal"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">File <span style="color: red;">*max size 5mb</span></label>
                                    <input type="file" name="file" class="form-control file" required>
                                    <div class="invalid-feedback errorfile"></div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%" style="text-align: center;">AKSI</th>
                        <th width="35%">Nomor</th>
                        <th width="35%">Perihal</th>
                        <th width="35%">Tanggal</th>
                        <th width="35%">Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($s_keluar as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td>
                                <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- button Disposisi modal-->
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                        <span class="fa fa-reply-all text-success"> Disposisi</span>
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <!-- button ubah modal-->
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                        <span class="fa fa-edit text-primary"> Ubah</span>
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <!-- button hapus modal-->
                                    <a href="<?= base_url('s_keluar/hapus/' . $item['id']); ?>" class="dropdown-item hapus">
                                        <span class="fa fa-trash text-danger"> Hapus</span>
                                    </a>
                                </div>
                                <!-- edit modal-->
                                <div class="modal fade" id="editmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('s_keluar/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Nomor</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="no" class="form-control no" value="<?= $item['no'] ?>" placeholder="Nomor">
                                                                <div class="invalid-feedback errorno"></div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label class="text-primary">Tanggal</label>
                                                                <input type="date" name="tanggal" class="form-control tanggal" value="<?= $item['tanggal'] ?>">
                                                                <div class="invalid-feedback errortanggal"></div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Perihal</label>
                                                                <textarea name="perihal" cols="30" class="form-control perihal" rows="10"><?= $item['perihal'] ?></textarea>
                                                                <div class="invalid-feedback errorperihal"></div>
                                                                <br>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="text-primary">File</label>
                                                                <input type="file" name="file" accept=".pdf" class="form-control file">
                                                                <div class="invalid-feedback errorfile"></div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                        <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;">
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#fileviewmodal<?= $id = $item['id'] ?>">
                                    <?= $item['no'] ?>
                                </button>
                                <!-- file view modal-->
                                <div class="modal fade" id="fileviewmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">File : <?= $item['no'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?= csrf_field() ?>
                                                <div class="modal-body" style="text-align:left ;">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <embed src="<?= base_url('writable/uploads/content/s_keluar/' . $item['file']) ?>" type='application/pdf' width='100%' height='750px'>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                            </td>

                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['perihal'] ?></td>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['tanggal'] ?></td>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['timestamp'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/s_keluar/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>