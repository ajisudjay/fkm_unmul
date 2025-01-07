<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Surat Masuk</h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('s_masuk/tambah'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="text-primary">Nomor Disposisi</label>
                                    <input type="text" name="no_disposisi" class="form-control no_disposisi" placeholder="Nomor Disposisi" required>
                                    <div class="invalid-feedback errorno_disposisi"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Tgl Surat Masuk</label>
                                    <input type="date" name="tgl_sm" class="form-control tgl_sm" placeholder="Tanggal Surat Masuk" required>
                                    <div class="invalid-feedback errortgl_sm"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-6">
                                    <label class="text-primary">Nomor Surat</label>
                                    <input type="text" name="no_surat" class="form-control no_surat" placeholder="Nomor Surat" required>
                                    <div class="invalid-feedback errorno_surat"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Tgl Surat</label>
                                    <input type="date" name="tgl_surat" class="form-control tgl_surat" placeholder="Tanggal Surat" required>
                                    <div class="invalid-feedback errortgl_surat"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Asal Surat</label>
                                    <input type="text" name="asal_surat" class="form-control asal_surat" placeholder="Asal Surat" required>
                                    <div class="invalid-feedback errorasal_surat"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Perihal</label>
                                    <input type="text" name="perihal" class="form-control perihal" placeholder="Perihal" required>
                                    <div class="invalid-feedback errorperihal"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Keterangan</label>
                                    <textarea name="keterangan" class="form-control keterangan"> - </textarea>
                                    <div class="invalid-feedback errorketerangan"></div>
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
                        <th width="15%">Nomor Disposisi</th>
                        <th width="10%">Tgl Surat Masuk</th>
                        <th width="15%">Nomor Surat</th>
                        <th width="25%">Perihal</th>
                        <th width="15%">Asal Surat</th>
                        <th width="25%">Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1 ?>
                    <?php foreach ($s_masuk as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td>
                                <button class="btn btn-outline-primary btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $nomor++ ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- button ubah modal-->
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                        <span class="fa fa-edit text-primary"> Ubah</span>
                                    </button>
                                    <div class="dropdown-divider"></div>
                                    <!-- button hapus modal-->
                                    <a href="<?= base_url('s_masuk/hapus/' . $item['id']); ?>" class="dropdown-item hapus">
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
                                                <form action="<?= base_url('s_masuk/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Nomor Disposisi</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="no_disposisi" class="form-control no_disposisi" value="<?= $item['no_disposisi'] ?>" placeholder="Nomor Disposisi">
                                                                <div class="invalid-feedback errorno_disposisi"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Tanggal Surat Masuk</label>
                                                                <input type="date" name="tgl_sm" class="form-control tgl_sm" value="<?= $item['tgl_sm'] ?>" placeholder="Tanggal Surat Masuk">
                                                                <div class="invalid-feedback errortgl_sm"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Nomor Surat</label>
                                                                <input type="text" name="no_surat" class="form-control no_surat" value="<?= $item['no_surat'] ?>" placeholder="Nomor Surat">
                                                                <div class="invalid-feedback errorno_surat"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Tanggal Surat</label>
                                                                <input type="date" name="tgl_surat" class="form-control tgl_surat" value="<?= $item['tgl_surat'] ?>" placeholder="Tanggal Surat">
                                                                <div class="invalid-feedback errortgl_surat"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Asal Surat</label>
                                                                <input type="text" name="asal_surat" class="form-control asal_surat" value="<?= $item['asal_surat'] ?>" placeholder="Asal Surat">
                                                                <div class="invalid-feedback errorasal_surat"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Perihal</label>
                                                                <input type="text" name="perihal" class="form-control perihal" value="<?= $item['perihal'] ?>" placeholder="Perihal">
                                                                <div class="invalid-feedback errorperihal"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Keterangan</label>
                                                                <input type="text" name="keterangan" class="form-control keterangan" value="<?= $item['keterangan'] ?>" placeholder="Keterangan">
                                                                <div class="invalid-feedback errorketerangan"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">File</label>
                                                                <input type="file" name="file" class="form-control file">
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
                                    <?= $item['no_disposisi'] ?>
                                </button>
                                <!-- file view modal-->
                                <div class="modal fade" id="fileviewmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Nomor Disposisi : <?= $item['no_disposisi'] ?></h5> | <span class="badge badge-pill badge-primary"><?= $item['tgl_sm'] ?></span> | <span class="badge badge-pill badge-warning"><?= $item['status'] ?></span>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="dt-responsive table-responsive">
                                                        <form action="<?= base_url('s_masuk/tambahdisposisi'); ?>" method="post">
                                                            <?= csrf_field() ?>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <table class="table table-hover-animation nowrap">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <h5> Nomor Surat : <?= $item['no_surat'] ?></h5>
                                                                                </td>
                                                                                <td>
                                                                                    <h5> Tanggal Surat : <?= $item['tgl_surat'] ?></h5>
                                                                                </td>
                                                                                <td>
                                                                                    <h5> Asal Surat : <?= $item['asal_surat'] ?></h5>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3">
                                                                                    <h5 class="modal-title">Perihal : <?= $item['perihal'] ?></h5>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3">
                                                                                    <h5 class="modal-title">Keterangan : <?= $item['keterangan'] ?></h5>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="text" name="id_sm" class="form-control id_sm" value="<?= $item['no_disposisi'] ?>" hidden>
                                                                                    <input type="text" name="kepada" class="form-control kepada" placeholder="Kepada" required>
                                                                                </td>
                                                                                <td>
                                                                                    <select name="status" class="form-control">
                                                                                        <option value="Sedang Diproses">Sedang Diproses</option>
                                                                                        <option value="Selesai">Selesai</option>
                                                                                        <option value="Ditolak">Ditolak</option>
                                                                                        <option value="Belum Disposisi">Belum Disposisi</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="submit" class="btn btn-primary btnSimpan">Tambah</button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3"><input type="text" name="tindak_lanjut" class="form-control tindak_lanjut" placeholder="Tindak Lanjut" required></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%">No</th>
                                                                    <th width="25%">Kepada</th>
                                                                    <th width="45%">Tindak Lanjut</th>
                                                                    <th width="30%">Log</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $no = 1 ?>
                                                                <?php $s_masuk = $item['no_disposisi'] ?>
                                                                <?php foreach ($disposisi as $item2) : ?>
                                                                    <?php if ($item2['id_sm'] == $s_masuk) { ?>
                                                                        <tr>
                                                                            <td><?= $no++ ?></td>
                                                                            <td><?= $item2['kepada'] ?></td>
                                                                            <td>
                                                                                <!-- button ubah disposisi modal-->
                                                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editdismodal<?= $id = $item2['id'] ?>">
                                                                                    <span> <?= $item2['tindak_lanjut'] ?></span>
                                                                                </button>
                                                                                <!-- ubah disposisi modal-->
                                                                                <div class="modal fade" id="editdismodal<?= $id = $item2['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Ubah Disposisi</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <form action="<?= base_url('s_masuk/editdisposisi'); ?>" method="post" class="edit">
                                                                                                    <?= csrf_field() ?>
                                                                                                    <div class="modal-body">
                                                                                                        <div class="row">
                                                                                                            <div class="col-lg-12">
                                                                                                                <label class="text-primary">Kepada</label>
                                                                                                                <input type="text" name="id" value="<?= $item2['id'] ?>" hidden>
                                                                                                                <input type="text" name="kepada" class="form-control kepada" value="<?= $item2['kepada'] ?>" placeholder="Kepada">
                                                                                                                <div class="invalid-feedback errorkepada"></div>
                                                                                                                <br>
                                                                                                            </div>
                                                                                                            <div class="col-lg-12">
                                                                                                                <label class="text-primary">Disposisi</label>
                                                                                                                <input type="text" name="tindak_lanjut" class="form-control tindak_lanjut" value="<?= $item2['tindak_lanjut'] ?>" placeholder="Tindak Lanjut">
                                                                                                                <div class="invalid-feedback errortindak_lanjut"></div>
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
                                                                            </td>
                                                                            <td><span class="badge badge-pill badge-secondary"><?= $item2['admin'] ?></span> | <span class="badge badge-pill badge-warning"><?= $item2['timestamp'] ?></span> | <a href="<?= base_url('s_masuk/hapusdisposisi/' . $item2['id']); ?>">
                                                                                    <span class="fa fa-trash text-danger"></span>
                                                                                </a></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body" style="text-align:left ;">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <embed src="<?= base_url('writable/uploads/content/s_masuk/' . $item['file']) ?>" type='application/pdf' width='100%' height='750px'>
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
        <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['tgl_sm'] ?></td>
        <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['no_surat'] ?></td>
        <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['perihal'] ?></td>
        <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['asal_surat'] ?></td>
        <td style="min-width: 75px;max-width: 300px; white-space: normal;"><span class="badge badge-pill badge-primary"><?= $item['status'] ?></span><span class="badge badge-pill badge-secondary"><?= $item['admin'] ?></span><br><span class="badge badge-pill badge-warning"><?= $item['timestamp'] ?></span></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    </table>
    </div>
</div>


<?= $this->include('backend/s_masuk/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>