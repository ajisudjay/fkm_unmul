<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Surat Keputusan</h4>
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
                    <form action="<?= base_url('sk/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="text-primary">Jenis</label>
                                    <select name="jenis" class="form-control jenis">
                                        <option value="Rektor">Rektor</option>
                                        <option value="Usulan">Usulan</option>
                                    </select>
                                    <div class="invalid-feedback errorjenis"></div>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-primary">Nomor</label>
                                    <input type="text" name="nomor" class="form-control nomor" placeholder="Nomor">
                                    <div class="invalid-feedback errornomor"></div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal">
                                    <div class="invalid-feedback errortanggal"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Sasaran</label>
                                    <select name="sasaran" class="form-control sasaran">
                                        <option value="Terbuka">Terbuka</option>
                                        <option value="Tertutup">Tertutup</option>
                                    </select>
                                    <div class="invalid-feedback errorsasaran"></div>
                                </div>
                                <div class="col-lg-5">
                                    <label class="text-primary">Kategori</label>
                                    <select name="kategori" class="form-control kategori">
                                        <?php foreach ($kategori_sk as $itemkat) : ?>
                                            <option value="<?= $itemkat['id'] ?>"><?= $itemkat['kategori'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback errorkategori"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Semester</label>
                                    <select name="semester" class="form-control semester">
                                        <?php foreach ($semester as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['semester'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback errorsemester"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Perihal</label>
                                    <textarea name="perihal" cols="30" class="form-control perihal" rows="10"></textarea>
                                    <div class="invalid-feedback errorperihal"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">File</label>
                                    <input type="file" name="file" accept=".pdf" class="form-control file" required>
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
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="3%" style="text-align: center;"><i class="fa fa-gear"></i></th>
                        <th width="10%">Nomor</th>
                        <th width="10%">Tanggal</th>
                        <th width="35%">Perihal</th>
                        <th width="10%">Semester</th>
                        <th width="10%">Kategori</th>
                        <th width="10%">Sasaran</th>
                        <th width="10%">Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($sk as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td>
                                <div class="btn-group dropright">
                                    <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- button ubah modal-->
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editmodal<?= $id = $item['id_sk'] ?>">
                                            <span class="feather icon-edit-1 text-primary"> Ubah</span>
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <!-- button hapus modal-->
                                        <a href="<?= base_url('sk/hapus/' . $item['id_sk']); ?>" class="dropdown-item hapus">
                                            <span class="feather icon-trash-2 text-danger"> Hapus</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- edit modal-->
                                <div class="modal fade" id="editmodal<?= $id = $item['id_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('sk/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="text-primary">Jenis</label>
                                                                <select name="jenis" class="form-control jenis">
                                                                    <option value="<?= $item['jenis'] ?>"><?= $item['jenis'] ?></option>
                                                                    <option value="Rektor">Rektor</option>
                                                                    <option value="Usulan">Usulan</option>
                                                                </select>
                                                                <div class="invalid-feedback errorjenis"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label class="text-primary">Nomor</label>
                                                                <input type="text" name="id" value="<?= $item['id_sk'] ?>" hidden>
                                                                <input type="text" name="nomor" class="form-control nomor" value="<?= $item['nomor'] ?>" placeholder="Nomor">
                                                                <div class="invalid-feedback errornomor"></div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label class="text-primary">Tanggal</label>
                                                                <input type="date" name="tanggal" class="form-control tanggal" value="<?= $item['tanggal'] ?>">
                                                                <div class="invalid-feedback errortanggal"></div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Sasaran</label>
                                                                <select name="sasaran" class="form-control sasaran">
                                                                    <option value="<?= $item['sasaran'] ?>"><?= $item['sasaran'] ?></option>
                                                                    <option value="Terbuka">Terbuka</option>
                                                                    <option value="Tertutup">Tertutup</option>
                                                                </select>
                                                                <div class="invalid-feedback errorsasaran"></div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <label class="text-primary">Kategori</label>
                                                                <select name="kategori" class="form-control kategori">
                                                                    <option value="<?= $item['id'] ?>"><?= $item['kategori'] ?></option>
                                                                    <?php foreach ($kategori_sk as $itemkat) : ?>
                                                                        <option value="<?= $itemkat['id'] ?>"><?= $itemkat['kategori'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                                <div class="invalid-feedback errorkategori"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Semester</label>
                                                                <select name="semester" class="form-control semester">
                                                                    <option value="<?= $item['id'] ?>"><?= $item['semester'] ?></option>
                                                                    <?php foreach ($semester as $itemsmt) : ?>
                                                                        <option value="<?= $itemsmt['id'] ?>"><?= $itemsmt['semester'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                                <div class="invalid-feedback errorsemester"></div>
                                                                <br>
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
                            <td style="white-space: normal;">
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#fileviewmodal<?= $id = $item['id_sk'] ?>">
                                    <?= $item['nomor'] ?>
                                </button>
                                <!-- file view modal-->
                                <div class="modal fade" id="fileviewmodal<?= $id = $item['id_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">File : <?= $item['nomor'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?= csrf_field() ?>
                                                <div class="modal-body" style="text-align:left ;">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <embed src="<?= base_url('writable/uploads/content/sk/' . $item['file']) ?>" type='application/pdf' width='100%' height='750px'>
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
                            </td>
                            <td><?= $item['tanggal'] ?></td>
                            <td style="white-space: normal;"><?= $item['perihal'] ?></td>
                            <td><?= $item['nama_semester'] ?></td>
                            <td><?= $item['nama_kategori'] ?></td>
                            <td><?= $item['sasaran'] ?></td>
                            <td><?= $item['timestamps'] . ' | ' . $item['admin'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('backend/sk/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>