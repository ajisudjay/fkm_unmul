<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Main Menu : <?= $halaman ?></h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <br>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('mainmenu/tambah'); ?>" method="post" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="text-primary">Urutan</label>
                                    <input type="text" name="urutan" class="form-control urutan" placeholder="Urutan">
                                    <div class="invalid-feedback errorUrutan"></div>
                                    <br>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Halaman</label>
                                    <select name="halaman" class="form-control halaman" readonly>
                                        <option value="<?= $halaman ?>"><?= $halaman ?></option>
                                    </select>
                                    <div class="invalid-feedback errorHalaman"></div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Main Menu</label>
                                    <input type="text" name="mainmenu" class="form-control mainmenu" placeholder="Main Menu">
                                    <div class="invalid-feedback errorMainmenu"></div>
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
                        <th width="10%" style="text-align: center;"><i class="fa fa-gear"></i></th>
                        <th width="60%">MAIN MENU</th>
                        <th width="20%">LOG</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td style="text-align: center;"> <button type="button" class="btn-sm btn-secondary border-0" data-toggle="modal" disabled>
                                <span class="feather icon-home text-default"></span>
                            </button></td>
                        <td>Beranda</td>
                    </tr>
                    <?php foreach ($mainmenu as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $item['urutan'] ?></td>
                            <td style="text-align: center;">
                                <div class="btn-group dropright">
                                    <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- button ubah modal-->
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                            <span class="feather icon-edit-1 text-primary"> Ubah</span>
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <!-- button hapus modal-->
                                        <a href="<?= base_url('mainmenu/hapus/' . $item['id']); ?>" class="dropdown-item hapus">
                                            <span class="feather icon-trash-2 text-danger"> Hapus</span>
                                        </a>
                                    </div>
                                </div>

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
                                                <form action="<?= base_url('mainmenu/edit'); ?>" method="post" class="edit">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-body" style="text-align:left ;">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Urutan</label>
                                                                <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                <input type="text" name="urutan" value="<?= $item['urutan'] ?>" class="form-control urutan" placeholder="Urutan">
                                                                <div class="invalid-feedback errorUrutan"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <label class="text-primary">Halaman</label>
                                                                <select name="halaman" class="form-control halaman" readonly>
                                                                    <option value="<?= $halaman ?>"><?= $halaman ?></option>
                                                                </select>
                                                                <div class="invalid-feedback errorHalaman"></div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Main Menu</label>
                                                                <input type="text" name="mainmenu" value="<?= $item['mainmenu'] ?>" class="form-control mainmenu" placeholder="Main Menu">
                                                                <div class="invalid-feedback errorMainmenu"></div>
                                                                <br>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                        <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <td><?= $item['mainmenu'] ?></td>
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
<?= $this->include('backend/mainmenu/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>