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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <?php if (session()->get('pesanInput')) { ?>
                                    <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                        <strong><?= session()->getFlashdata('pesanInput') ?></strong>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanGagal')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show flash" role="alert">
                                        <strong><?= session()->getFlashdata('pesanGagal') ?></strong>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanHapus')) { ?>
                                    <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                        <strong><?= session()->getFlashdata('pesanHapus') ?></strong>
                                    </div>
                                <?php } ?>
                                <div class="card" style="padding: 25px;">
                                    <form action="<?= base_url('s_masuk/view'); ?>" method="post" class="tahun">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select name="tahun" class="form-control tahun">
                                                    <?php foreach ($tahun_surat as $tahun) : ?>
                                                        <option value="<?= $tahun['tahun'] ?>"><?= $tahun['tahun'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-primary btnTampilkan" type="submit">Tampilkan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="bg-transparent border-0" id="result"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
        $(document).ready(function() {
            $(".tahun").submit(function(e) {
                var formObj = $(this);
                var formURL = formObj.attr("action");
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btnTampilkan').attr('disable', 'disabled');
                        $('.btnTampilkan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnTampilkan').removeAttr('disable', 'disabled');
                        $('.btnTampilkan').html('Tampilkan');
                    },
                    success: function(response) {
                        $("#result").html(response.data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
                e.preventDefault(); //Prevent Default action.
            });
        });
    </script>
    <?= $this->include('backend/layouts/js') ?>
</body>
<!-- END: Body-->

</html>