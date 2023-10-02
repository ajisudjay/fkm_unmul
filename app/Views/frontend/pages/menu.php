<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/navbar') ?>

    <!-- Isi Konten Website -->

    <!-- Laboratorium -->
    <div class="our_department_area">
        <div class="container">
            <div class="row" style="margin-top: -50px;">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-55">
                        <h3>Fakultas Kedokteran<br>
                            Universitas Mulawarman</h3>
                        <div class="info-scroll mt-5 bradcam_text">
                            <p class="text-primary">Scroll Kebawah untuk menampilkan data</p>
                            <i class="fa fa-arrow-down text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cards">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="box-berita">
                        <div class="single_department">
                            <div class="department_content">
                                <p>
                                    <span style="font-size: 30px;" class="fa fa-check-circle text-primary"></span>
                                </p>
                                <h4><a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>">Mitra Kerjasama</a></h4>
                                <a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>" class="learn_more btn btn-primary text-light">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="box-berita">
                        <div class="single_department">
                            <div class="department_content">
                                <p>
                                    <span style="font-size: 30px;" class="fa fa-check-circle text-primary"></span>
                                </p>
                                <h4><a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>">Menu Tambahan lainnya</a></h4>
                                <a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>" class="learn_more btn btn-primary text-light">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="box-berita">
                        <div class="single_department">
                            <div class="department_content">
                                <p>
                                    <span style="font-size: 30px;" class="fa fa-check-circle text-primary"></span>
                                </p>
                                <h4><a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>">Menu Tambahan lainnya</a></h4>
                                <a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>" class="learn_more btn btn-primary text-light">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="box-berita">
                        <div class="single_department">
                            <div class="department_content">
                                <p>
                                    <span style="font-size: 30px;" class="fa fa-check-circle text-primary"></span>
                                </p>
                                <h4><a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>">Menu Tambahan lainnya </a></h4>
                                <a href="<?= base_url('/laboratorium-detail/mitra-kerjasama'); ?>" class="learn_more btn btn-primary text-light">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Laboratorium -->

    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>