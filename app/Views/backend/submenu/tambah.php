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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnSimpan">Tambah</button>
    </div>
</form>
<hr>