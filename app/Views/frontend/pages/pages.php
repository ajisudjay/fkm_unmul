<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/navbar') ?>
    <!-- Isi Konten Website -->

    <!-- bradcam_area_start  -->
    <div class="bradcam_area bradcam_overlay">
        <div class="container">
            <div class="row">
                <div class=" col-xl-12">
                    <div class="bradcam_text">
                        <?php foreach ($content as $item) : ?>
                            <h3><?= $item['submenu'] ?></h3>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <!-- Start Content-->
    <div class="card">
        <section class="sample-text-area">
            <div class="container box_1170">
                <?php foreach ($content as $item) : ?>
                    <div align="right">
                        <p class="text-secondary"><a href="<?= base_url('/'); ?>">FKM UNMUL /</a> <?= $item['submenu'] ?></p>
                    </div>
                    <?= $item['content'] ?>
                <?php endforeach ?>
            </div>
        </section>
    </div>
    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>