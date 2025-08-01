<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Sub Menu</h4>
        <!-- button tambah modal -->
        <a href="submenu/tambahform">
            <button type="button" class="btn btn-primary">
                <span class="feather icon-plus text-light"></span>
            </button>
        </a>
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
                        <?= csrf_field() ?>
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
                                    <div class="invalid-feedback errormainmenu"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Urutan</label>
                                    <input type="number" min="1" name="urutan" class="form-control urutan" placeholder="Urutan">
                                    <div class="invalid-feedback errorurutan"></div>
                                    <br>
                                </div>
                                <div class="col-lg-9">
                                    <label class="text-primary">Sub Menu</label>
                                    <input type="text" name="submenu" class="form-control submenu" placeholder="Sub Menu">
                                    <div class="invalid-feedback errorsubmenu"></div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Content</label>
                                    <textarea name="isi" id="isi" rows="10" cols="80"></textarea>
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
                        <th style="text-align: center;" width="5%"><i class="fa fa-gear"></i></th>
                        <th width="10%">MAIN MENU</th>
                        <th width="55%">SUB MENU</th>
                        <th width="20%">LOG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($submenu as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td><?= $no++ ?></td>
                            <td align="center"><?= $item['urutan_submenu'] ?></td>
                            <td style="text-align: center;min-width: 100px;max-width: 300px; white-space: normal;">
                                <div class="btn-group dropright">
                                    <button class="btn btn-outline-primary fa fa-ellipsis-v" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <!-- button ubah modal-->
                                        <form action="<?= base_url('submenu/editform'); ?>" method="post" class="editform">
                                            <?= csrf_field(); ?>
                                            <input type="text" name="slug" value="<?= $item['slug'] ?>" hidden>
                                            <button class="dropdown-item" type="submit"><span class="feather icon-edit-1 text-primary"> Ubah</span></button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <!-- button hapus modal-->
                                        <a href="<?= base_url('submenu/hapus/' . $item['submenu_id']); ?>" class="dropdown-item hapus">
                                            <span class="feather icon-trash-2 text-danger"> Hapus</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td><?= $item['mainmenu'] ?></td>
                            <td style="min-width: 150px;max-width: 500px; white-space: normal;"><?= $item['submenu'] ?></td>
                            <td><?= $item['timestamp_submenu'] . ' | ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('backend/submenu/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>