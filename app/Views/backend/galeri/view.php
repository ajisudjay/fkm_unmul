<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Galeri</h4>
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
                    <form action="<?= base_url('galeri/tambah'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama">
                                    <div class="invalid-feedback errornama"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Gambar <span style="color: red;">*max size 2mb</span></label>
                                    <input type="file" name="file" class="form-control file" accept="image/*">
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
                        <th width="30%">Nama</th>
                        <th width="25%" style="text-align: center;">Gambar</th>
                        <th width="25%">URL</th>
                        <th width="10%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($galeri as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;">
                                <!-- button hapus modal-->
                                <a href="<?= base_url('galeri/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td style="min-width: 100px;max-width: 300px; white-space: normal;"><?= $item['nama'] ?></td>

                            <td style="text-align: center;"><img src="<?= base_url('writable/uploads/content/galeri/thumb/' . $item['gambar'] . ''); ?>" width="100%"></td>
                            <td>
                                <input type="text" class="form-control copy-btn" value="<?= base_url() ?>/writable/uploads/content/galeri/<?= $item['gambar'] ?>">
                                <br>
                            </td>
                            <td><?= $item['timestamp'] . ' | ' . $item['admin'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/galeri/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>