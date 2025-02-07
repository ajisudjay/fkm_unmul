<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?= $this->include('backend/layouts/header') ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
    <?= $this->include('backend/layouts/topnavbar') ?>
    <?php if ($lvl === 'Superadmin') { ?>
        <?= $this->include('backend/layouts/sidenavbar/superadmin') ?>
    <?php } elseif ($lvl === 'Admin Website') { ?>
        <?= $this->include('backend/layouts/sidenavbar/adminwebsite') ?>
    <?php } elseif ($lvl === 'Admin eOffice') { ?>
        <?= $this->include('backend/layouts/sidenavbar/eoffice') ?>
    <?php } elseif ($lvl === 'Dosen') { ?>
        <?= $this->include('backend/layouts/sidenavbar/dosen') ?>
    <?php } elseif ($lvl === 'Tendik') { ?>
        <?= $this->include('backend/layouts/sidenavbar/tendik') ?>
    <?php } ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="card">
                        <div class="row">
                            <div class="col-12">
                                <?php if (session()->get('pesanInput')) { ?>
                                    <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                        <strong><?= session()->getFlashdata('pesanInput') ?></strong>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanHapus')) { ?>
                                    <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                        <strong><?= session()->getFlashdata('pesanHapus') ?></strong>
                                    </div>
                                <?php } ?>
                                <div class="container-fluid">
                                    <div class="card-block">
                                        <br>
                                        <h4 class="mb-0">Berita</h4>
                                        <form action="<?= base_url('berita/tambah'); ?>" enctype="multipart/form-data" method="post" class="tambah">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label class="text-primary">Kategori</label>
                                                        <select name="kategori" class="form-control">
                                                            <option value="Berita">Berita</option>
                                                            <option value="Pengumuman">Pengumuman</option>
                                                            <option value="Kegiatan">Kegiatan</option>
                                                        </select>
                                                        <div class="invalid-feedback errortanggal"></div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="text-primary">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control tanggal" required>
                                                        <div class="invalid-feedback errorTanggal"></div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <label class="text-primary">Banner <span style="color: red;">*Max-Size : 2 mb | extension : jpg/jpeg/png/PNG</span></label>
                                                        <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                        <div class="invalid-feedback errorGambar"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="text-primary">Judul</label>
                                                        <input type="text" name="judul" class="form-control judul" placeholder="Judul" required>
                                                        <div class="invalid-feedback errorJudul"></div>
                                                        <br>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-12">
                                                        <label class="text-primary">Content</label>
                                                        <textarea name="isi" id="isi"></textarea>
                                                        <div class="invalid-feedback errorIsi"></div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/berita">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                                <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?= $this->include('backend/layouts/js_view') ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <?= $this->include('backend/berita/ajax') ?>
    <?= $this->include('backend/layouts/js') ?>
    <?= $this->include('backend/layouts/js_view') ?>
</body>
<!-- END: Body-->
<script>
    CKEDITOR.replace('isi');
</script>


</html>