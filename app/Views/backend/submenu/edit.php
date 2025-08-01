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
                                        <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanInput') ?>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanHapus')) { ?>
                                    <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                        <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanHapus') ?>
                                    </div>
                                <?php } ?>
                                <div class="container-fluid">
                                    <div class="card-block">
                                        <br>
                                        <h4 class="mb-0">Sub Menu</h4>
                                        <form action="<?= base_url('submenu/edit'); ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="text-primary">Main Menu</label>
                                                        <input type="text" name="id" value="<?= $submenu['submenu_id'] ?>" hidden>
                                                        <select name="mainmenu" class="form-control mainmenu" required>
                                                            <option value="<?= $submenu['mainmenu_id'] ?>"><?= $submenu['mainmenu'] ?></option>
                                                            <?php foreach ($mainmenu as $item_mainmenu) : ?>
                                                                <option value="<?= $item_mainmenu['id'] ?>"><?= $item_mainmenu['mainmenu'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <div class="invalid-feedback errormainmenu"></div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="text-primary">Urutan</label>
                                                        <input type="number" min="1" name="urutan" class="form-control urutan" value="<?= $submenu['urutan_submenu'] ?>" required>
                                                        <div class="invalid-feedback errorurutan"></div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="text-primary">Sub Menu</label>
                                                        <input type="text" name="submenu" class="form-control submenu" value="<?= $submenu['submenu'] ?>" required>
                                                        <div class="invalid-feedback errorsubmenu"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="text-primary">Content</label>
                                                        <textarea name="isi" id="isi-edit" rows="10" cols="80"><?= $submenu['content'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/submenu">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                                <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?= $this->include('backend/layouts/js_edit') ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <?= $this->include('backend/submenu/ajax') ?>
    <?= $this->include('backend/layouts/js') ?>

</body>
<!-- END: Body-->
<script>
    CKEDITOR.replace('isi-edit');
</script>


</html>