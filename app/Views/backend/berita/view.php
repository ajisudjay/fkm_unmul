<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Berita</h4>
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
                    <form action="<?= base_url('berita/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?php csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-primary">Judul</label>
                                    <input type="text" name="judul" class="form-control judul" placeholder="Judul" required>
                                    <div class="invalid-feedback errorJudul"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-3">
                                    <label class="text-primary">Banner</label>
                                    <input type="file" name="file" class="form-control gambar" accept="image/*" required>
                                    <div class="invalid-feedback errorGambar"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal" placeholder="Tanggal" required>
                                    <div class="invalid-feedback errorTanggal"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Tag</label>
                                    <input type="text" name="tag" class="form-control tag" placeholder="Tag" required>
                                    <div class="invalid-feedback errorTag"></div>
                                    <br>
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
                        <th width="5%" style="text-align: center;">AKSI</th>
                        <th width="40%">JUDUL</th>
                        <th width="10%">TANGGAL</th>
                        <th width="25%" style="text-align: center;">BANNER</th>
                        <th width="5%">DILIHAT</th>
                        <th width="10%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($berita as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;">
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
                                                <form action="<?= base_url('berita/edit'); ?>" enctype="multipart/form-data" method="post" class="edit">
                                                    <?php csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Judul</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="judul" class="form-control judul" value="<?= $item['judul'] ?>" required>
                                                                <div class="invalid-feedback errorJudul"></div>
                                                                <br>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-3">
                                                                <img src="<?= base_url('writable/uploads/content/berita/' . $item['banner']); ?>" alt="avatar" height="100" width="100">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Banner</label>
                                                                <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                                <div class="invalid-feedback errorGambar"></div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Tanggal</label>
                                                                <input type="date" name="tanggal" class="form-control tanggal" value="<?= $item['tanggal'] ?>" required>
                                                                <div class="invalid-feedback errorTanggal"></div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Tag</label>
                                                                <input type="text" name="tag" class="form-control tag" value="<?= $item['tag'] ?>" required>
                                                                <div class="invalid-feedback errorTag"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Content</label>
                                                                <?php $idx = 'isi' . $item['id'] ?>
                                                                <textarea name="isi" id="<?= $idx ?>"><?= $item['isi'] ?></textarea>
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
                                <a href="<?= base_url('berita/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['judul'] ?></td>
                            <td><?= $item['tanggal'] ?></td>
                            <td style="text-align: center;"><img src="<?= base_url('writable/uploads/content/berita/' . $item['banner'] . ''); ?>" width="100%"></td>
                            <td><?= $item['dilihat'] ?></td>
                            <td><?= $item['timestamp'] . ' | ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>