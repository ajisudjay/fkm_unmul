<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Kategori Surat</h4>
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
                    <form action="<?= base_url('kategori_surat/tambah'); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="text-primary">Kode Surat</label>
                                    <input type="text" name="kategori_surat" class="form-control kategori_surat" placeholder="Kategori">
                                    <div class="invalid-feedback errorkategori_surat"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Kategori</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama">
                                    <div class="invalid-feedback errornama"></div>
                                    <br>
                                </div>
                                <br>
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
                        <th width="40%">Kategori</th>
                        <th width="50%">Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($kategori_surat as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;">
                                <div class="btn-group dropright">
                                    <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- button ubah disposisi modal-->
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editdismodal<?= $id = $item['id'] ?>">
                                            <span class="btn-sm btn-warning feather icon-edit text-default"> Ubah</span>
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <!-- button ubah disposisi modal-->
                                        <a href="<?= base_url('kategori_surat/hapus/' . $item['id']); ?>" class="hapus">
                                            <button type="button" class="dropdown-item">
                                                <span class="btn-sm btn-danger feather icon-trash-2 text-default"> Hapus</span>
                                            </button>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <!-- button hapus modal-->

                                    </div>
                                </div>

                                <!-- ubah kategori modal-->
                                <div class="modal fade" id="editdismodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('kategori_surat/edit'); ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Kategori</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="kategori_surat" class="form-control kategori_surat" value="<?= $item['kode_surat'] ?>">
                                                                <div class="invalid-feedback errorkategori_surat"></div>
                                                                <br>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Kategori</label>
                                                                <input type="text" name="nama" class="form-control nama" value="<?= $item['nama'] ?>">
                                                                <div class="invalid-feedback errornama"></div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['kode_surat'] ?></td>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['nama'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/kategori_surat/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>