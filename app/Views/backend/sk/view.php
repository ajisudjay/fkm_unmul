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
                    <form action="<?= base_url('sk/tambah'); ?>" method="post" class="tambah">
                        <?php csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="text-primary">Jenis</label>
                                    <input type="text" name="jenis" class="form-control jenis" placeholder="Jenis">
                                    <div class="invalid-feedback errorjenis"></div>
                                    <br>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Nomor</label>
                                    <input type="text" name="nomor" class="form-control nomor" placeholder="Nomor">
                                    <div class="invalid-feedback errornomor"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="text" name="tanggal" class="form-control tanggal" placeholder="Main Menu">
                                    <div class="invalid-feedback errortanggal"></div>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Perihal</label>
                                    <input type="text" name="perihal" class="form-control perihal" placeholder="Main Menu">
                                    <div class="invalid-feedback errorperihal"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Kategori</label>
                                    <input type="text" name="kategori" class="form-control kategori" placeholder="Main Menu">
                                    <div class="invalid-feedback errorkategori"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Sasaran</label>
                                    <input type="text" name="sasaran" class="form-control sasaran" placeholder="Main Menu">
                                    <div class="invalid-feedback errorsasaran"></div>
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
                        <th width="3%">No</th>
                        <th width="3%" style="text-align: center;">AKSI</th>
                        <th width="15%">Jenis</th>
                        <th width="15%">Nomor</th>
                        <th width="15%">Tanggal</th>
                        <th width="45%">Perihal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($sk as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td>
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                    <span class="feather icon-edit-1 text-default"></span>
                                </button>
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
                                                <form action="<?= base_url('mainmenu/edit'); ?>" method="post" class="edit">
                                                    <?php csrf_field() ?>
                                                    <div class="modal-body" style="text-align:left ;">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Urutan</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="urutan" value="<?= $item['id'] ?>" class="form-control urutan" placeholder="Urutan">
                                                                <div class="invalid-feedback errorUrutan"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <label class="text-primary">Main Menu</label>
                                                                <input type="text" name="mainmenu" value="<?= $item['id'] ?>" class="form-control mainmenu" placeholder="Main Menu">
                                                                <div class="invalid-feedback errorMainmenu"></div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                        <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- button hapus modal-->
                                <a href="<?= base_url('mainmenu/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['jenis'] ?></td>
                            <td><?= $item['jenis'] ?></td>
                            <td><?= $item['tanggal'] ?></td>
                            <td><?= $item['perihal'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('backend/sk/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>