<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?= $this->include('backend/layouts/header') ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
    <?= $this->include('backend/layouts/topnavbar') ?>
    <?php if ($lvl === 'Superadmin') { ?>
        <?= $this->include('backend/layouts/sidenavbar/superadmin') ?>
    <?php } elseif ($lvl === 'Admin Website') { ?>
        <?= $this->include('backend/layouts/sidenavbar/adminwebsite') ?>
    <?php } elseif ($lvl === 'Dosen') { ?>
        <?= $this->include('backend/layouts/sidenavbar/dosen') ?>
    <?php } elseif ($lvl === 'Admin eOffice') { ?>
        <?= $this->include('backend/layouts/sidenavbar/eoffice') ?>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="container-fluid p-5" align="center">
                                        <span><img class="round mb-1" src="<?= base_url('writable/uploads/content/user/' . $foto); ?>" height="100" width="100"></span>
                                        <h4 class="mb-1">Selamat Datang</h4>
                                        <h4 class="mb-1"><?= $admin . ' - ' . $lvl ?></h4>
                                        <h4 class="mb-0">Fakultas Kesehatan Masyarakat Universitas Mulawarman</h4>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <!-- ini isi -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <?= $this->include('backend/layouts/js') ?>
</body>
<!-- END: Body-->

</html>