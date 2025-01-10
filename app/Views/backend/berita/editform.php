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
                                        <form action="<?= base_url('berita/edit'); ?>" enctype="multipart/form-data" method="post" class="edit">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12" align="center">
                                                        <img src="<?= base_url('writable/uploads/content/berita/' . $berita['banner']); ?>" height="200px">
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="text-primary">Banner <span style="color: red;">*max size 2mb</span></label>
                                                        <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                        <div class="invalid-feedback errorGambar"></div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="text-primary">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control tanggal" value="<?= $berita['tanggal'] ?>" required>
                                                        <div class="invalid-feedback errorTanggal"></div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="text-primary">Judul</label>
                                                        <input type="text" name="id" value="<?= $berita['id'] ?>" hidden>
                                                        <input type="text" name="judul" class="form-control judul" value="<?= $berita['judul'] ?>" required>
                                                        <div class="invalid-feedback errorJudul"></div>
                                                        <br>
                                                    </div>
                                                    <br>
                                                    <!-- <div class="col-lg-3">
                                                        <label class="text-primary">Tag</label>
                                                        <input type="text" name="tag" class="form-control tag" value="<?= $berita['tag'] ?>" required>
                                                        <div class="invalid-feedback errorTag"></div>
                                                        <br>
                                                    </div> -->
                                                    <div class="col-lg-12">
                                                        <label class="text-primary">Content</label>
                                                        <textarea name="isi" id="isi-edit"><?= $berita['isi'] ?></textarea>
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
    CKEDITOR.replace('isi-edit');
</script>


</html>