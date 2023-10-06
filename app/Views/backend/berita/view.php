<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Berita</h4>
        <!-- button tambah modal -->
        <div class="col-lg-3" align="right">
            <a href="/berita#tambah">
                <button type="button" class="btn btn-primary">
                    <span class="feather icon-plus text-light"></span>
                </button>
            </a>
        </div>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%" style="text-align: center;">AKSI</th>
                        <th width="33%">JUDUL</th>
                        <th width="12%">TANGGAL</th>
                        <th width="25%" style="text-align: center;">BANNER</th>
                        <th width="20%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($berita as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;min-width: 100px; max-width: 150px;">
                                <a href="/berita-edit/<?= $item['slug'] ?>">
                                    <button type="button" class="btn-sm btn-primary border-0">
                                        <span class="feather icon-edit-1 text-default"></span>
                                    </button>
                                </a>

                                <!-- button hapus modal-->
                                <a href="<?= base_url('berita/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td style="min-width: 20%; max-width: 25%; white-space: normal;"><?= $item['judul'] ?></td>
                            <td><?= $item['tanggal'] ?></td>
                            <?php
                            if ($item['banner'] === NULL) {
                                $banner = 'img/content/filenotfound.JPG';
                            } else {
                                $banner = 'writable/uploads/content/berita/' . $item['banner'];
                            }
                            ?>
                            <td style="text-align: center;"><img src="<?= base_url($banner); ?>" width="50%"></td>
                            <td style="min-width: 10%; max-width: 25%; white-space: normal;"><?= $item['timestamp'] . ' | ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <section id="tambah">
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
                    <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                </div>
            </form>
        </section>
    </div>
</div>

<!-- SCRIPT AJAX -->
<script>
    CKEDITOR.replace('isitambah');
</script>
<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>