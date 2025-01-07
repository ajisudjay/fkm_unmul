<div class="container-fluid">
    <div class="card-header">
        <?php
        if ($lvl === 'Superadmin') {
            $hakakses = '';
        } else {
            $hakakses = 'hidden';
        }
        ?>
        <h4 class="mb-0">Hak Akses</h4>
        <a href="<?= base_url('user'); ?>"><button class="btn btn-danger" type="button">Kembali</button></a>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('user/tambahakses'); ?>" method="post" class="tambah">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label class="text-primary">Username</label>
                        <input type="text" name="username" class="form-control username" value="<?= $namauser ?>" readonly>
                        <div class="invalid-feedback errornama"></div>
                        <br>
                    </div>
                    <div class="col-lg-8">
                        <label class="text-primary">Hak Akses</label>
                        <div class="input-group mb-3">
                            <select name="hak_akses" class="form-control">
                                <option value="Content">Content</option>
                                <option value="Konfigurasi">Konfigurasi</option>
                                <option value="SDM">SDM</option>
                                <option value="SK">SK</option>
                                <option value="Surat">Surat</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="80%">Hak Akses</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1 ?>
                    <?php foreach ($hak_akses as $item) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <!-- ISI VIEW -->
                            <td><?= $item['hak_akses'] ?></td>
                            <td> <!-- button hapus modal-->
                                <a href="<?= base_url('user/hapusakses/' . $item['id']); ?>" class="dropdown-item">
                                    <span class="feather icon-trash-2 text-danger"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/user/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>