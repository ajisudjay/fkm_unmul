<?= $this->include('frontend/layouts/header') ?>

<body onload="removeLoader();">
    <?= $this->include('frontend/layouts/navbar') ?>
    <!-- Slider Beranda -->
    <div class="slider_area">
        <div class="slider_active owl-carousel carousels">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                <div class="container">
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center slider_bg_2">
                <div class="container">
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center slider_bg_3">
                <div class="container">
                </div>
            </div>
        </div>
    </div>
    <!-- akhir slider beranda -->

    <!-- Aplikasi -->
    <div class="box">
        <div class="service_area">
            <div class="container p-0">
                <div class="row no-gutters" style="text-align:center">
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="https://sikemas.fkm.unmul.ac.id/" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/sikemas.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="https://graps.fkm.unmul.ac.id" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/graps.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="http://perpustakaan.fkm.unmul.ac.id" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/pustaka.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="https://fkm.unmul.ac.id/login" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/eoffice.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a href="https://mictoph.fkm.unmul.ac.id" target="_blank" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/mictoph.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="https://lab.fkm.unmul.ac.id" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/lab.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Aplikasi -->

    <!-- Visi MisiArea -->
    <div class="welcome_docmed_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6" style="margin-top:10% ;">
                    <div class="box-visi">
                        <div class="welcome_thumb">
                            <img src="<?= base_url('/img/content/wd1.PNG'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="welcome_docmed_info">
                        <div class="slide-in-text">
                            <h4 style="color:360A5B;">Visi</h4>
                            <p><?= $konfigurasi['visi'] ?></p>
                        </div>
                        <div class="box-berita">
                            <h4 style="color:360A5B;">Misi</h4>
                            <p><?= $konfigurasi['misi'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- visi misi end -->

    <!-- Berita dan Artikel -->
    <div class="header-area">
        <div class="header-top_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center">
                            <h3 style="color: #360A5B;">Berita Terbaru</h3>
                            <p style="color: #360A5B;">Berita dan Artikel Terbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our_department_area">
        <div class="container">
            <!-- Limit Tampilkan max 6 berita -->
            <div class="row">
                <div class="cards">
                    <?php foreach ($berita as $item_berita) : ?>
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="box-berita">
                                <div class="single_department">
                                    <div class="department_thumb">
                                        <img src="<?= base_url('writable/uploads/content/berita/' . $item_berita['banner'] . ''); ?>" height="300px">
                                    </div>
                                    <div class="department_content">
                                        <!-- limit Judul max 6 kata -->
                                        <h3><a href="<?= base_url('informasi-detail/' . $item_berita['slug']); ?>"><?= $item_berita['judul'] ?></a></h3>
                                        <!-- Limit Deskripsi 25 kata -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p style="font-size: 12px;">
                                                    <i class="fa fa-calendar mr-1"></i>
                                                    <?= $item_berita['tanggal'] ?>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p style="font-size: 12px;">
                                                    <i class="fa fa-user mr-1"></i>
                                                    <?= $item_berita['penulis'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <!-- Lihat Semua Berita -->
            <div align="right" class="mt-5">
                <a href="<?= base_url('informasi'); ?>" class="boxed-btn3">Lihat Semua</a>
            </div>
        </div>
    </div>
    <!-- Akhir Berita dan Artikel -->

    <!-- Kerjasama Fakultas -->
    <div class="header-area">
        <div class="header-top_areaungu">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center">
                            <h3 style="color: white;">Mitra Kerjasama</h3>
                            <p style="color: white">List dan Dokumentasi Mitra FKM Unmul</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testmonial_area">
        <div class="testmonial_active owl-carousel">
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <p>Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit
                                </p>
                                <div class="testmonial_author">
                                    <h4>Rumah Sakit IA Moeis</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_2 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <p>Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit
                                </p>
                                <div class="testmonial_author">
                                    <h4>Rumah Sakit IA Moeis</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <p>Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit Judul Kerjasama Fakultas kedokteran dengan Rumah Sakit
                                </p>
                                <div class="testmonial_author">
                                    <h4>Rumah Sakit IA Moeis</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lihat Semua Kerjasama -->
        <center class="mt-5">
            <a href="<?= base_url('/mitra'); ?>" class="boxed-btn3">Lihat Semua</a>
        </center>
    </div>
    <!-- Akhir Kerjasama Fakultas-->
    <!-- Pimpinan Fakultas -->
    <div class="expert_doctors_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="doctors_title mb-55">
                        <h3>Tentang Kami</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="cards">
                        <div class="expert_active owl-carousel">
                            <div class="single_expert">
                                <div class="box-berita">
                                    <div class="expert_thumb">
                                        <img src="img/content/dekan.png">
                                    </div>
                                    <div class="experts_name text-center">
                                        <h5>Prof. Dr. Iwan M. Ramdan,M.Kes</h5>
                                        <span>Dekan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_expert">
                                <div class="box-berita">
                                    <div class="expert_thumb">
                                        <img src="img/content/wd13.png">
                                    </div>
                                    <div class="experts_name text-center">
                                        <h5>Ratih Wirapuspita W,Ph.D</h5>
                                        <span>Wakil Dekan I</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_expert">
                                <div class="box-berita">
                                    <div class="expert_thumb">
                                        <img src="img/content/wd2.png">
                                    </div>
                                    <div class="experts_name text-center">
                                        <h5>Dr.Ratno Adrianto,M.Kes</h5>
                                        <span>Wakil Dekan II</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_expert">
                                <div class="box-berita">
                                    <div class="expert_thumb">
                                        <img src="img/content/kaprodis1.png">
                                    </div>
                                    <div class="experts_name text-center">
                                        <h5>Blego Sedionoto, P.hD</h5>
                                        <span>Kaprodi S1 SKM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_expert">
                                <div class="box-berita">
                                    <div class="expert_thumb">
                                        <img src="img/content/kaprodis2.png">
                                    </div>
                                    <div class="experts_name text-center">
                                        <h5>Dr. Irfansyah B P, M.Kes</h5>
                                        <span>Kaprodi S2 MKM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Akhir Pimpinan Fakultas -->
</body>

<?= $this->include('frontend/layouts/footer') ?>
<?= $this->include('frontend/layouts/js') ?>