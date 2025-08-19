<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Berita</h4>
        <!-- button tambah modal -->
        <a href="berita/tambahform">
            <button type="button" class="btn btn-primary">
                <span class="feather icon-plus text-light"></span>
            </button>
        </a>
    </div>

    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%" style="text-align: center;"><i class="fa fa-gear"></i></th>
                        <th width="10%">TANGGAL</th>
                        <th width="40%">JUDUL</th>
                        <th width="20%" style="text-align: center;">BANNER</th>
                        <th width="20%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($berita as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;min-width: 100px;max-width: 300px; white-space: normal;">
                                <div class="btn-group dropright">
                                    <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- button ubah modal-->
                                        <a href="/berita-edit/<?= $item['slug'] ?>">
                                            <button type="button" class="dropdown-item">
                                                <span class="feather icon-edit-1 text-primary"> Ubah</span>
                                            </button>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <!-- button hapus modal-->
                                        <a href="<?= base_url('berita/hapus/' . $item['id']); ?>" class="dropdown-item hapus">
                                            <span class="feather icon-trash-2 text-danger"> Hapus</span>
                                        </a>
                                    </div>
                                </div>
                            <td><?= $item['tanggal'] ?></td>
                            <td style="min-width: 200px;max-width: 400px; white-space: normal;"><?= $item['judul'] ?></td>
                            <?php
                            if ($item['banner'] === NULL) {
                                $banner = 'img/content/filenotfound.JPG';
                            } else {
                                $banner = 'writable/uploads/content/berita/thumb/' . $item['banner'] . '';
                            }
                            ?>

                            <td style="text-align: center;"><img src="<?= base_url($banner); ?>" width="100%"></td>
                            <td style="min-width: 75px;max-width: 300px; white-space: normal;"></span><span class="badge badge-pill badge-secondary">
                                    <?= $item['timestamp'] ?>
                                </span>
                                <br><span class="badge badge-pill badge-warning"><?= $item['nama_admin'] ?></span>
                                <br><span class="badge badge-pill badge-primary"><?= $item['tingkat'] ?></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('isitambah');
</script>
<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>