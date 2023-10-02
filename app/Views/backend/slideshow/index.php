<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?= $this->include('backend/layouts/header') ?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
    <?= $this->include('backend/layouts/topnavbar') ?>
    <?= $this->include('backend/layouts/sidenavbar/superadmin') ?>

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
                                        <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanInput') ?>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanGagal')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show flash" role="alert">
                                        <strong>Gagal !</strong> <?= session()->getFlashdata('pesanGagal') ?>
                                    </div>
                                <?php } ?>
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
            $.ajax({
                url: '<?= base_url('slideshow/view') ?>',
                dataType: 'json',
                success: function(response) {
                    $("#result").html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    </script>
    <?= $this->include('backend/layouts/js') ?>
</body>
<!-- END: Body-->

</html>