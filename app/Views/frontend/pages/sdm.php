<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/navbar') ?>
    <!-- Isi Konten Website -->

    <!-- bradcam_area_start  -->
    <div class="bradcam_area bradcam_overlay" style="height: 100px;">
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

    <!-- profil SDM -->
    <center class="info-scroll mt-5 bradcam_text">
        <p class="text-primary">Scroll Kebawah untuk menampilkan data</p>
        <i class="fa fa-arrow-down text-primary"></i>
    </center>
    <div class="expert_doctors_area doctor_page">
        <div class="container">
            <div class="row cards" style="margin-top: -50px;">
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/1.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/2.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/3.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/4.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/6.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/7.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/8.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="box-gambar">
                        <div class="single_expert mb-40">
                            <div class="expert_thumb">
                                <img src="<?= base_url(''); ?>/img/experts/9.png" alt="">
                            </div>
                            <div class="experts_name text-center">
                                <h3>Mirazul Alom</h3>
                                <span>Neurologist</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Profil SDM -->

    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>