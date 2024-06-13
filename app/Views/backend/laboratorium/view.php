<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Laboratorium</h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('laboratorium/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label class="text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama" required>
                                    <div class="invalid-feedback errorNama"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-4">
                                    <label class="text-primary">Gambar</label>
                                    <input type="file" name="file" class="form-control gambar" accept="image/*" required>
                                    <div class="invalid-feedback errorGambar"></div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Content</label>
                                    <textarea name="isi" id="isitambah"></textarea>
                                    <div class="invalid-feedback errorIsi"></div>
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
                        <th width="10%" style="text-align: center;">AKSI</th>
                        <th width="65%">Nama</th>
                        <th width="30%" style="text-align: center;">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($laboratorium as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-sm btn-success border-0" data-toggle="modal" data-target="#detailmodal<?= $id = $item['id'] ?>">
                                    <span class="feather icon-info text-default"></span>
                                </button>
                                <!-- detail modal-->
                                <div class="modal fade" id="detailmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" align="center"><?= $item['nama'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <img src="<?= base_url('writable/uploads/content/laboratorium/' . $item['gambar'] . ''); ?>" width="30%">
                                                            <br>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <?= $item['content'] ?>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                    <span class="feather icon-edit-1 text-default"></span>
                                </button>
                                <!-- edit modal-->
                                <div class="modal fade" id="editmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('laboratorium/edit'); ?>" enctype="multipart/form-data" method="post" class="edit">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <label class="text-primary">Nama</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="nama" class="form-control nama" value="<?= $item['nama'] ?>" required>
                                                                <div class="invalid-feedback errorJudul"></div>
                                                                <br>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-4">
                                                                <label class="text-primary">Gambar</label>
                                                                <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                                <div class="invalid-feedback errorGambar"></div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Content</label>
                                                                <?php $idx = 'isi' . $item['id'] ?>
                                                                <textarea name="isi" id="<?= $idx ?>"><?= $item['content'] ?></textarea>
                                                                <div class="invalid-feedback errorIsi"></div>
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
                                <!-- button hapus modal-->
                                <a href="<?= base_url('laboratorium/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['nama'] ?></td>
                            <td style="text-align: center;"><img src="<?= base_url('writable/uploads/content/laboratorium/' . $item['gambar'] . ''); ?>" width="100%"></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/laboratorium/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>