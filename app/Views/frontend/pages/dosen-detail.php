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
                        <h3 style="font-size: 30px;"><?= $dosen['nama'] ?>
                        </h3>
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
                    <div class="col-lg-4">
                        <img src="<?= base_url('/writable/uploads/content/dosen/thumb/' . $dosen['gambar']); ?>" width="300" height="300" style="border-radius: 2%;">
                    </div>
                    <div class="col-lg-6">
                        <table border="0">
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">Nama Lengkap</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['nama'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">Jenis Kelamin</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['jk'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">NIP</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['nip'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">NIDN</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['nidn'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">Bidang Ilmu</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['bidang'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">Program Studi</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['homebase'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: bold;">Jabatan Fungsional</p>
                                </td>
                                <td>
                                    <p style="font-weight: bold;"> : </p>
                                </td>
                                <td>
                                    <p><?= $dosen['jabatan'] ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-2" align="center">
                        <a target="_blank" style="color: #60B3FD;" href="<?= $dosen['sinta'] ?>"><img src="https://fk.unmul.ac.id/writable/uploads/content/galeri/1709186637_b1cfe5935c2995c7b838.png" width="100%" style="border-radius: 2%;"></a>
                        <a target="_blank" style="color: #60B3FD;" href="<?= $dosen['sinta'] ?>"><button class="btn btn-primary">Sinta</button></a>
                        <br>
                        <br>
                        <br>
                        <a target="_blank" style="color: #60B3FD;" href="<?= $dosen['gs'] ?>"><img src="https://fk.unmul.ac.id/writable/uploads/content/galeri/1709186220_2294936cdd354199f0bc.png" width="50%" style="border-radius: 2%;"></a>
                        <br>
                        <a target="_blank" style="color: #60B3FD;" href="<?= $dosen['gs'] ?>"><button class="btn btn-warning">Google Scholar</button></a>
                    </div>
                </div>
                <br>
                <div class="row" align="center">
                    <div class="col-lg-4">
                        <h4>S1</h4>
                        <p class="small"><?= $dosen['s1'] ?></p>
                    </div>
                    <div class="col-lg-4">
                        <h4>S2</h4>
                        <p class="small"><?= $dosen['s2'] ?></p>
                    </div>
                    <div class="col-lg-4">
                        <h4>S3</h4>
                        <p class="small"><?= $dosen['s3'] ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>