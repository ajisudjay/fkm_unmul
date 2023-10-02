<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Sub Menu</h4>
        <!-- button tambah modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
            <span class="feather icon-plus text-light"></span>
        </button>
    </div>
    <!-- tambah modal-->
    <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('submenu/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?php csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="text-primary">Main Menu</label>
                                    <select name="mainmenu" class="form-control mainmenu">
                                        <option value="">Pilih Main Menu</option>
                                        <?php foreach ($mainmenu as $item_mainmenu) : ?>
                                            <option value="<?= $item_mainmenu['id'] ?>"><?= $item_mainmenu['mainmenu'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback errorMainmenu"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Urutan</label>
                                    <input type="text" name="urutan" class="form-control urutan" placeholder="Urutan">
                                    <div class="invalid-feedback errorUrutan"></div>
                                    <br>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Sub Menu</label>
                                    <input type="text" name="submenu" class="form-control submenu" placeholder="Sub Menu">
                                    <div class="invalid-feedback errorSubmenu"></div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Content</label>
                                    <textarea name="isi" id="isi" rows="10" cols="80"></textarea>
                                    <div class="invalid-feedback errorIsi"></div>
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
                        <th width="5%">Urutan</th>
                        <th width="5%" style="text-align: center;">AKSI</th>
                        <th width="15%">MAIN MENU</th>
                        <th width="15%">SUB MENU</th>
                        <th width="55%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($submenu as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td align="center"><?= $item['urutan_submenu'] ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['submenu_id'] ?>">
                                    <span class="feather icon-edit-1 text-default"></span>
                                </button>
                                <!-- edit modal-->
                                <div class="modal fade" id="editmodal<?= $id = $item['submenu_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('submenu/edit'); ?>" enctype="multipart/form-data" method="post" class="edit">
                                                    <?php csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Main Menu</label>
                                                                <input type="text" name="id" value="<?= $item['submenu_id'] ?>" hidden>
                                                                <select name="mainmenu" class="form-control mainmenu">
                                                                    <option value="<?= $item['mainmenu_id'] ?>"><?= $item['mainmenu'] ?></option>
                                                                    <?php foreach ($mainmenu as $item_mainmenu) : ?>
                                                                        <option value="<?= $item_mainmenu['id'] ?>"><?= $item_mainmenu['mainmenu'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                                <div class="invalid-feedback errorMainmenu"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="text-primary">Urutan</label>
                                                                <input type="text" name="urutan" class="form-control urutan" value="<?= $item['urutan_submenu'] ?>">
                                                                <div class="invalid-feedback errorUrutan"></div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <label class="text-primary">Sub Menu</label>
                                                                <input type="text" name="submenu" class="form-control submenu" value="<?= $item['submenu'] ?>">
                                                                <div class="invalid-feedback errorSubmenu"></div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="text-primary">Content</label>
                                                                <?php $idx = 'isi' . $item['submenu_id'] ?>
                                                                <textarea name="isi" id="<?= $idx ?>"><?= $item['content'] ?></textarea>
                                                                <div class="invalid-feedback errorIsi"></div>
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
                                <!-- button hapus modal-->
                                <a href="<?= base_url('submenu/hapus/' . $item['submenu_id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['mainmenu'] ?></td>
                            <td><?= $item['submenu'] ?></td>
                            <td><?= $item['timestamp'] . ' | ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/submenu/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>