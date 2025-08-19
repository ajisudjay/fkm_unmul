<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0"><?= $title ?></h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('link/tambah'); ?>" method="post" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-primary">Kategori</label>
                                    <select name="kategori" class="form-control kategori">
                                        <option value="Partner">Partner</option>
                                        <option value="Journal">Journal</option>
                                        <option value="Library">Library</option>
                                    </select>

                                    <div class="invalid-feedback errorkategori"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Judul</label>
                                    <input type="text" name="judul" class="form-control judul" placeholder="Judul">
                                    <div class="invalid-feedback errorjudul"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="text-primary">Link</label>
                                    <input type="text" name="link" class="form-control link" placeholder="Link">
                                    <div class="invalid-feedback errorlink"></div>
                                    <br>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">

        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%" style="text-align: center;">AKSI</th>
                        <th width="10%">Kategori</th>
                        <th width="30%">Judul</th>
                        <th width="40%">Link</th>
                        <th width="10%">Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($link as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td style="text-align: center;">
                                <!-- button hapus modal-->
                                <a href="<?= base_url('link/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['kategori'] ?></td>
                            <td style="min-width: 200px;max-width: 250px; white-space: normal;"><?= $item['judul'] ?></a></td>
                            <td style="min-width: 150px;max-width: 250px; white-space: normal;"><a href="<?= $item['link'] ?>" target="_blank"><?= $item['link'] ?></a></td>
                            <td style="min-width: 75px;max-width: 300px; white-space: normal;"></span><span class="badge badge-pill badge-secondary">
                                    <?= $item['timestamp'] ?>
                                </span><br><span class="badge badge-pill badge-warning"><?= $item['nama_admin'] ?></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('backend/link/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>