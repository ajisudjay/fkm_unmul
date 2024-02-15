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
                        <h3><?= $berita['kategori'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="<?= base_url('/writable/uploads/content/berita/' . $berita['banner'] . ''); ?>" width="550px" height="650px">
                        </div>
                        <div class="blog_details">
                            <h2>
                                <?= $berita['judul'] ?>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><i class="fa fa-user"></i><?= $berita['penulis'] ?></li>
                                <li><i class="fa fa-calendar"></i> <?= $berita['tanggal'] ?></li>
                                <li><i class="fa fa-list"></i> <?= $berita['kategori'] ?></li>
                            </ul>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><i class="fa fa-tag"></i> <?= $berita['tag'] ?></li>
                            </ul>
                            <p class="excert">
                                <?= $berita['isi'] ?>
                            </p>

                        </div>
                    </div>
                </div>

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