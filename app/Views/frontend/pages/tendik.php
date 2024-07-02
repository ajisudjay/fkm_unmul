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
                        <h3><?= $title_pages ?></h3>
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
                <div class="row">
                    <?php foreach ($tendik as $item) : ?>
                        <div class="col-lg-3" align="center">
                            <div class="single_expert">
                                <div class="expert_thumb" align="center">
                                    <img src="<?= base_url('/writable/uploads/content/tendik/thumb/' . $item['gambar']); ?>" width="250" height="250" style="border-radius: 2%;">
                                </div>
                                <div class="experts_name text-center">
                                    <b style="color: #60B3FD;"><?= $item['nama'] ?></b><br>
                                    <span>NIP. <?= $item['nip'] ?></span><br><br>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    </div>
    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>