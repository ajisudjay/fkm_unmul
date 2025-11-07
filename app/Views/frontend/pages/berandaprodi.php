<?= $this->include('frontend/layouts/header') ?>

<body onload="removeLoader();">
    <?= $this->include('frontend/layouts/navbarprodi') ?>
    <!-- Slider Beranda -->
    <div class="slider_area">
        <div class="slider_active owl-carousel carousels">
            <?php foreach ($slideshow as $item) : ?>
                <div class="single_slider  d-flex align-items-center" style="background-image: url(<?= base_url('writable/uploads/content/slideshow/' . $item['gambar']); ?>);">
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- akhir slider beranda -->

    <!-- Aplikasi -->
    <div class="box">
        <div class="service_area">
            <div class="container p-0">
                <div class="row no-gutters" style="text-align:center">
                    <div class="col-xl-3">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="http://perpustakaan.fkm.unmul.ac.id" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/pustaka.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="single_service">
                            <div class="icon">
                                <a target="_blank" href="https://fkm.unmul.ac.id/login" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/eoffice.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="single_service">
                            <div class="icon">
                                <a href="https://mictoph.fkm.unmul.ac.id" target="_blank" class="boxed-btn3-white">
                                    <img src="<?= base_url('/img/logo/mictoph.png'); ?>" width="70px" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
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
        <div class="section_title text-center">
            <h3 style=" color: #360A5B;">Visi Misi Program Studi</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="welcome_docmed_info">
                        <div class="box-berita">
                            <h4 style="color:360A5B;">Visi</h4>
                            <p align="justify"><?= $konfigurasi['visi'] ?></p>
                        </div>
                        <div class="box-berita">
                            <h4 style="color:360A5B;">Misi</h4>
                            <p align="justify"><?= $konfigurasi['misi'] ?></p>
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
                                    <div class="col-lg-12">
                                        <p class="badge badge-pill badge-success">
                                            <i class="fa fa-newspaper-o"></i>
                                            <?= $item_berita['tingkat'] ?>
                                        </p>
                                    </div>
                                    <div class="department_thumb">
                                        <a href="<?= base_url('informasi-detail/' . $item_berita['slug']); ?>">
                                            <img src="<?= base_url('writable/uploads/content/berita/thumb/' . $item_berita['banner']); ?>" height="300px">
                                        </a>
                                    </div>
                                    <div class="department_content">
                                        <!-- limit Judul max 6 kata -->
                                        <p><a href="<?= base_url('informasi-detail/' . $item_berita['slug']); ?>"><?= substr($item_berita['judul'], 0, 80) ?></a></p>
                                        <!-- Limit Deskripsi 25 kata -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span class="badge badge-pill badge-warning"><i class="fa fa-calender-o"></i><?= $item_berita['tanggal'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="badge badge-pill badge-info"><i class="fa fa-calender-o"></i><?= $item_berita['nama_admin'] ?></span>
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
            <div align="center" class="mt-5">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testmonial_area">
        <div class="testmonial_active owl-carousel">
            <?php foreach ($mitra as $item_mitra) : ?>
                <div class="single-testmonial overlay2" style="background-image: url(<?= base_url('writable/uploads/content/mitra/' . $item_mitra['gambar']); ?>)">
                    <div class="container">
                        <div class="row">

                            <div class="col-xl-10 offset-xl-1">
                                <div class="testmonial_info text-center">
                                    <h4 style="font-size: larger;"><?= $item_mitra['nama'] ?>
                                    </h4>
                                    <div class="testmonial_author">
                                        <h4>Fakultas Kesehatan Masyarakat Universitas Mulawarman</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- Lihat Semua Kerjasama -->
        <center class="mt-5">
            <a href="https://drive.google.com/drive/folders/1Q781-XJMI7UNyC5q8igMhkaza5Geh6JS?usp=share_link" class="boxed-btn3" target="_blank">Lihat Selengkapnya</a>
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
                            <?php foreach ($pejabat as $item_pejabat) : ?>
                                <div class="single_expert">
                                    <div class="box-berita">
                                        <div class="expert_thumb">
                                            <img src="<?= base_url('writable/uploads/content/pejabat/' . $item_pejabat['gambar']); ?>">
                                        </div>
                                        <div class="experts_name text-center">
                                            <h5><?= $item_pejabat['jabatan'] ?></h5>
                                            <hr>
                                            <h5><?= $item_pejabat['nama'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
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