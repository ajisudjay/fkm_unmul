<div class="container-fluid">
    <div class="card-block">
        <br>
        <div class="row">
            <div class="col-lg-9">
                <h4 class="mb-0">Sub Menu</h4>
            </div>
            <div class="col-lg-3" align="right">
                <a href="/submenu#tambah">
                    <button type="button" class="btn btn-primary">
                        <span class="feather icon-plus text-light"></span>
                    </button>
                </a>
            </div>
        </div>
        <br>
        <div class="dt-responsive table-responsive">
            <table id="simpletable" class="table table-striped table-hover-animation nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%">Urutan</th>
                        <th width="10%" style="text-align: center;">AKSI</th>
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
                            <td style="text-align: center;min-width:150px;">
                                <!-- button edit-->
                                <a href="/submenu-edit/<?= $item['slug'] ?>">
                                    <button type="button" class="btn-sm btn-primary border-0">
                                        <span class="feather icon-edit-1 text-default"></span>
                                    </button>
                                </a>
                                <!-- button hapus-->
                                <a href="<?= base_url('submenu/hapus/' . $item['submenu_id']); ?>" class="hapus">
                                    <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                                </a>
                            <td><?= $item['mainmenu'] ?></td>
                            <td style="min-width: 300px;max-width: 500px; white-space: normal;"><?= $item['submenu'] ?></td>
                            <td><?= $item['timestamp'] . ' | ' . $item['penulis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <section id="tambah">
            <form action="<?= base_url('submenu/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                <?php csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label class="text-primary">Main Menu</label>
                            <select name="mainmenu" class="form-control mainmenu" required>
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
                            <input type="text" name="urutan" class="form-control urutan" placeholder="Urutan" required>
                            <div class="invalid-feedback errorUrutan"></div>
                            <br>
                        </div>
                        <div class="col-lg-6">
                            <label class="text-primary">Sub Menu</label>
                            <input type="text" name="submenu" class="form-control submenu" placeholder="Sub Menu" required>
                            <div class="invalid-feedback errorSubmenu"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="text-primary">Content</label>
                            <textarea name="isi" id="isi" rows="10" cols="80"></textarea>
                            <div class="invalid-feedback errorIsi"></div>
                            <br>
                        </div>
                        <div class="col-lg-12">
                            <label class="text-primary">Tag</label>
                            <input type="text" name="tag" class="form-control tag" placeholder="Tag" required>
                            <div class="invalid-feedback errortag"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSimpan">Tambah</button>
                </div>
            </form>
        </section>
    </div>
</div>
<?= $this->include('backend/submenu/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>
<script>
    CKEDITOR.replace('isi');
</script>