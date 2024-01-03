<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Slideshow</h4>
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
                    <form action="<?= base_url('slideshow/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?php csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="text-primary">Urutan</label>
                                    <input type="text" name="urutan" class="form-control urutan" placeholder="Urutan" required>
                                    <div class="invalid-feedback errorurutan"></div>
                                    <br>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama" required>
                                    <div class="invalid-feedback errorNama"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Gambar <span style="color: red;">*max size 2mb</span></label>
                                    <input type="file" name="file" class="form-control gambar" accept="image/*" required>
                                    <div class="invalid-feedback errorGambar"></div>
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
                        <th width="35%">Nama</th>
                        <th width="55%" style="text-align: center;">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($slideshow as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $item['urutan'] ?></td>
                            <td style="text-align: center;">
                                <!-- button hapus modal-->
                                <a href="<?= base_url('slideshow/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['nama'] ?></td>
                            <td style="text-align: center;"><img src="<?= base_url('writable/uploads/content/slideshow/' . $item['gambar'] . ''); ?>" width="100%"></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/slideshow/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>