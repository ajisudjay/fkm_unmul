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
                <h3>Magister Kesehatan Masyarakat</h3>
                <div class="row">
                    <?php foreach ($dosens2kesmas as $item) : ?>
                        <div class="col-lg-4" align="center">
                            <div class="card">
                                <a href="<?= 'dosen-detail/' . $item['nip'] ?> ">
                                    <img src="<?= base_url('/writable/uploads/content/dosen/thumb/' . $item['gambar']); ?>" width="350px" height="350px" style="border-radius: 2%;">
                                </a>
                                <div class="card">
                                    <b style="color: #60B3FD;"><?= $item['nama'] ?></b>
                                    <p>NIP. <?= $item['nip'] ?><br><i span class="fa fa-id-badge text-primary"></i> <?= $item['bidang'] ?>
                                        <br>
                                        <a target="_blank" style="color: #60B3FD;" href="<?= $item['sinta'] ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-link"> Sinta</i></button></a> | </i> <a target="_blank" style="color: #60B3FD;" href="<?= $item['gs'] ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-link"> g-Scholar</i></button></a>
                                    </p>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php endforeach ?>
                </div>
                <h3>Sarjana Kesehatan Masyarakat</h3>
                <div class="row">
                    <?php foreach ($dosens1kesmas as $item) : ?>
                        <div class="col-lg-4" align="center">
                            <div class="card">
                                <a href="<?= 'dosen-detail/' . $item['nip'] ?> ">
                                    <img src="<?= base_url('/writable/uploads/content/dosen/thumb/' . $item['gambar']); ?>" width="350px" height="350px" style="border-radius: 2%;">
                                </a>
                                <div class="card">
                                    <b style="color: #60B3FD;"><?= $item['nama'] ?></b>
                                    <p>NIP. <?= $item['nip'] ?><br><i span class="fa fa-id-badge text-primary"></i> <?= $item['bidang'] ?>
                                        <br>
                                        <a target="_blank" style="color: #60B3FD;" href="<?= $item['sinta'] ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-link"> Sinta</i></button></a> | </i> <a target="_blank" style="color: #60B3FD;" href="<?= $item['gs'] ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-link"> g-Scholar</i></button></a>
                                    </p>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php endforeach ?>
                </div>
                <h3>Sarjana Gizi</h3>
                <div class="row">
                    <?php foreach ($dosengizi as $item) : ?>
                        <div class="col-lg-4" align="center">
                            <div class="card">
                                <a href="<?= 'dosen-detail/' . $item['nip'] ?> ">
                                    <img src="<?= base_url('/writable/uploads/content/dosen/thumb/' . $item['gambar']); ?>" width="350px" height="350px" style="border-radius: 2%;">
                                </a>
                                <div class="card">
                                    <b style="color: #60B3FD;"><?= $item['nama'] ?></b>
                                    <p>NIP. <?= $item['nip'] ?><br><i span class="fa fa-id-badge text-primary"></i> <?= $item['bidang'] ?>
                                        <br>
                                        <a target="_blank" style="color: #60B3FD;" href="<?= $item['sinta'] ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-link"> Sinta</i></button></a> | </i> <a target="_blank" style="color: #60B3FD;" href="<?= $item['gs'] ?>"><button class="btn btn-sm btn-warning"><i class="fa fa-link"> g-Scholar</i></button></a>
                                    </p>
                                </div>
                            </div>
                            <br>
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