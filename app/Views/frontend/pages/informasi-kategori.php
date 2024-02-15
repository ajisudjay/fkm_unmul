<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/navbar') ?>
    <!-- Isi Konten Website -->
    <!-- bradcam_area_start  -->
    <div class="bradcam_area bradcam_overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3><?= $judul ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <!-- Berita -->
                <!-- View data max 5 per page -->
                <div class="col-lg-9 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="row">
                                <?php foreach ($berita_kategori as $item) : ?>
                                    <div class="col-lg-12">
                                        <div class="blog_details">
                                            <a class="d-inline-block" href="<?= base_url('informasi-detail/' . $item['slug']); ?>">
                                                <!-- Maksimal tampil 10 kata -->
                                                <h3>
                                                    <?= $item['judul'] ?>
                                                </h3>
                                            </a>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="blog-info-link">
                                                        <li><i class="fa fa-user"></i> <?= $item['penulis'] ?></li>
                                                        <li><i class="fa fa-calendar"></i> <?= $item['tanggal'] ?></li>
                                                        <li><i class="fa fa-list"></i> <?= $item['kategori'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </article>
                        <center class="mt-5">
                            <a href="<?= base_url('informasi-lengkap'); ?>" class="boxed-btn3">Lihat Lengkap</a>
                        </center>
                    </div>
                </div>
                <!-- Akhir Berita -->

                <!-- Sidebar -->
                <?= $this->include('frontend/layouts/sidebar') ?>
                <!-- akhir sidebar -->

            </div>
        </div>
    </section>

    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>