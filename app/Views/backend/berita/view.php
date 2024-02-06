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
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="text-primary">Kategori</label>
                                    <select name="kategori" class="form-control">
                                        <option value="Berita">Berita</option>
                                        <option value="Pengumuman">Pengumuman</option>
                                        <option value="Kegiatan">Kegiatan</option>
                                    </select>
                                    <div class="invalid-feedback errortanggal"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Banner <span style="color: red;">*max size 2mb</span></label>
                                    <input type="file" name="file" class="form-control file" accept="image/*">
                                    <div class="invalid-feedback errorfile"></div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal" placeholder="Tanggal">
                                    <div class="invalid-feedback errortanggal"></div>
                                    <br>
                                </div>
                                <!-- <div class="col-lg-5">
                                    <label class="text-primary">Tag</label>
                                    <input type="text" name="tag" class="form-control tag" placeholder="Tag">
                                    <div class="invalid-feedback errortag"></div>
                                    <br>
                                </div> -->
                                <div class="col-lg-12">
                                    <label class="text-primary">Judul</label>
                                    <input type="text" name="judul" class="form-control judul" placeholder="Judul">
                                    <div class="invalid-feedback errorjudul"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Content</label>
                                    <textarea name="isi" id="isitambah"></textarea>
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
                        <th width="5%">No</th>
                        <th style="text-align: center;">AKSI</th>
                        <th width="10%">TANGGAL</th>
                        <th width="45%">JUDUL</th>
                        <th width="25%" style="text-align: center;">BANNER</th>
                        <th width="30%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($berita as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;min-width: 100px;max-width: 300px; white-space: normal;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="/berita-edit/<?= $item['slug'] ?>">
                                            <button type="button" class="btn-sm btn-primary border-0">
                                                <span class="feather icon-edit-1 text-default"></span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- button hapus modal-->
                                        <a href="<?= base_url('berita/hapus/' . $item['id']); ?>" class="hapus">
                                            <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                        </a>
                                    </div>
                                </div>
                            <td><?= $item['tanggal'] ?></td>
                            <td style="min-width: 200px;max-width: 400px; white-space: normal;"><?= $item['judul'] ?></td>
                            <?php
                            if ($item['banner'] === NULL) {
                                $banner = 'img/content/filenotfound.JPG';
                            } else {
                                $banner = 'writable/uploads/content/berita/thumb/' . $item['banner'] . '';
                            }
                            ?>

                            <td style="text-align: center;"><img src="<?= base_url($banner); ?>" width="100%"></td>
                            <td style="min-width: 150px;max-width: 200px; white-space: normal;"><?= $item['timestamp'] . '   ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('isitambah');
</script>
<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>