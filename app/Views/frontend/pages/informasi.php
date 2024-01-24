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
                        <h3>Berita, Pengumuman & Kegiatan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <?php foreach ($beritalengkap as $item) : ?>
                    <div class="col-lg-9">
                        <div class="posts-list">
                            <div class="single-post">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="blog_item_img">
                                            <a class="d-inline-block" href="<?= base_url('informasi-detail/' . $item['slug']); ?>">
                                                <img class="card-img rounded-0" src="<?= base_url('/writable/uploads/content/berita/' . $item['banner']); ?>" style="width: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        isi dasda
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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