<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/navbar') ?>
    <!-- Isi Konten Website -->

    <!-- bradcam_area_start  -->
    <div class="bradcam_area bradcam_overlay" style="height: 300px;">
        <div class="container">
            <div class="row" style="margin-top: -50px;">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3><?= $slug ?></h3>
                        <p><a href="<?= base_url('/'); ?>">Beranda /</a> <?= $title ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <!-- Start Deskripsi-->
    <section class="sample-text-area">
        <div class="container box_1170">
            <h3 class="text-heading">Deskripsi Laboratorium</h3>

        </div>
    </section>
    <!-- End Deskripsi-->

    <!-- Mulai Galeri-->
    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <h3>Galeri</h3>
                <div class="row gallery-item">
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g1.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g1.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g2.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g2.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g3.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g3.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url(''); ?>/img/elements/g4.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g4.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url(''); ?>/img/elements/g5.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g5.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g6.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g6.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g7.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g7.jpg);"></div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(''); ?>/img/elements/g8.jpg" class="img-pop-up">
                            <div class="single-gallery-image" style="background: url(<?= base_url(''); ?>/img/elements/g8.jpg);"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Galeri -->

    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>