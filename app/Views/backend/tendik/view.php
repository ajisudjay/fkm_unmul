<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Tendik</h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tendik/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?php csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="text-primary">NIP</label>
                                    <input type="text" name="nip" class="form-control nip" placeholder="NIP" required>
                                    <div class="invalid-feedback errorNip"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama" required>
                                    <div class="invalid-feedback errorNama"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-6">
                                    <label class="text-primary">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control jabatan" placeholder="Jabatan" required>
                                    <div class="invalid-feedback errorJabatan"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Ruangan</label>
                                    <input type="text" name="ruangan" class="form-control ruangan" placeholder="Ruangan" required>
                                    <div class="invalid-feedback errorRuangan"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Foto</label>
                                    <input type="file" name="file" class="form-control gambar" accept="image/*" required>
                                    <div class="invalid-feedback errorGambar"></div>
                                </div>
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
                        <th width="20">NIP</th>
                        <th width="20%">NAMA</th>
                        <th width="10%">JABATAN</th>
                        <th width="10%">RUANGAN</th>
                        <th width="15%" style="text-align: center;">FOTO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($tendik as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <!-- ISI VIEW -->
                            <td style="text-align: center;">
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                    <span class="feather icon-edit-1 text-default"></span>
                                </button>
                                <!-- edit modal-->
                                <div class="modal fade" id="editmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('tendik/edit'); ?>" enctype="multipart/form-data" method="post" class="edit">
                                                    <?php csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">NIP</label>
                                                                <input type="text" name="id" class="form-control id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="nip" class="form-control nip" value="<?= $item['nip'] ?>" required>
                                                                <div class="invalid-feedback errorNip"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Nama</label>
                                                                <input type="text" name="nama" class="form-control nama" value="<?= $item['nama'] ?>" required>
                                                                <div class="invalid-feedback errorNama"></div>
                                                                <br>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Jabatan</label>
                                                                <input type="text" name="jabatan" class="form-control jabatan" value="<?= $item['jabatan'] ?>" required>
                                                                <div class="invalid-feedback errorJabatan"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="text-primary">Ruangan</label>
                                                                <input type="text" name="ruangan" class="form-control ruangan" value="<?= $item['ruangan'] ?>" required>
                                                                <div class="invalid-feedback errorRuangan"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Foto</label>
                                                                <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                                <div class="invalid-feedback errorGambar"></div>
                                                            </div>
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
                                <!-- button hapus modal-->
                                <a href="<?= base_url('tendik/hapus/' . $item['id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['nip'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['jabatan'] ?></td>
                            <td><?= $item['ruangan'] ?></td>
                            <td style="text-align: center;"><img src="<?= base_url('writable/uploads/content/tendik/' . $item['gambar'] . ''); ?>" width="100%"></td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/tendik/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>