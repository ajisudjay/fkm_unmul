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
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                                <thead>
                                    <tr>
                                        <th width="2%">No</th>
                                        <th width="10%">Nomor</th>
                                        <th width="10%">Tanggal</th>
                                        <th width="35%">Perihal</th>
                                        <th width="10%">Semester</th>
                                        <th width="10%">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($sk as $item) : ?>
                                        <tr>
                                            <!-- ISI VIEW -->
                                            <td><?= $no++ ?></td>
                                            <td style="white-space: normal;">
                                                <button type="button" class="btn-sm btn-success border-0" data-toggle="modal" data-target="#fileviewmodal<?= $id = $item['id_sk'] ?>">
                                                    <?= $item['nomor'] ?>
                                                </button>
                                                <!-- file view modal-->
                                                <div class="modal fade" id="fileviewmodal<?= $id = $item['id_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">File : <?= $item['nomor'] ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= csrf_field() ?>
                                                                <div class="modal-body" style="text-align:left ;">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <embed src="<?= base_url('writable/uploads/content/sk/' . $item['file']) ?>" type='application/pdf' width='100%' height='750px'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $item['tanggal'] ?></td>
                                            <td style="white-space: normal;"><?= $item['perihal'] ?></td>
                                            <td><?= $item['nama_semester'] ?></td>
                                            <td><?= $item['nama_kategori'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Akhir Isi Konten Website -->
    <?= $this->include('frontend/layouts/footer') ?>
</body>

<?= $this->include('frontend/layouts/js') ?>