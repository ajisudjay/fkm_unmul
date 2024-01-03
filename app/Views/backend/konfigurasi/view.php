<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Konfigurasi</h4>
        <br>
        <br>
    </div>
    <div class="card-block">
        <?php foreach ($konfigurasi as $item) : ?>
            <!-- ISI FORM -->
            <form action="<?= base_url('konfigurasi/editfoto'); ?>" method="post" enctype="multipart/form-data" class="editfoto">
                <?php csrf_field() ?>
                <div class="row">
                    <div class="col-lg-4">
                        <img src="<?= base_url('writable/uploads/content/konfigurasi/' . $item['foto']); ?>" width="50%">
                    </div>
                    <div class="col-lg-8">
                        &nbsp;
                    </div>
                    <div class="col-lg-3">
                        <br>
                        <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                        <input type="file" name="foto" accept="image/*" class="form-control foto">
                        <div class="invalid-feedback errorfoto"></div>
                    </div>
                    <div class="col-lg-3">
                        <br>
                        <button type="submit" class="btn btn-primary btnEditfoto">Perbarui</button>
                        <br>
                        <br>
                    </div>
                </div>
            </form>
            <form action="<?= base_url('konfigurasi/edit'); ?>" method="post" class="edit">
                <?php csrf_field() ?>
                <div class="row">
                    <div class="col-lg-12">
                        <label> Visi :</label>
                        <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                        <textarea name="visi" class="form-control visi" rows="5"><?= $item['visi'] ?></textarea>
                        <div class="invalid-feedback errorVisi"></div>
                        <br>
                    </div>
                    <div class="col-lg-12">
                        <label> Misi :</label>
                        <textarea name="misi" class="form-control misi" rows="30"><?= $item['misi'] ?></textarea>
                        <div class="invalid-feedback errorMisi"></div>
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label> Email :</label><br>
                        <input type="text" name="email" class="form-control email" value="<?= $item['email'] ?>">
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                    <div class="col-lg-6">
                        <label> Telepon :</label><br>
                        <input type="text" name="telepon" class="form-control telepon" value="<?= $item['telepon'] ?>">
                        <div class="invalid-feedback errorTelepon"></div>
                        <br>
                    </div>
                    <div class="col-lg-12">
                        <label> Alamat :</label><br>
                        <textarea name="alamat" class="form-control alamat" rows="5"><?= $item['alamat'] ?></textarea>
                        <div class="invalid-feedback errorAlamat"></div>
                        <br>
                    </div>
                    <div class="col-lg-4">
                        <label> Instagram :</label><br>
                        <input type="text" name="ig" class="form-control ig" value="<?= $item['ig'] ?>">
                        <div class="invalid-feedback errorIg"></div>
                    </div>
                    <div class="col-lg-4">
                        <label> Facebook :</label><br>
                        <input type="text" name="fb" class="form-control fb" value="<?= $item['fb'] ?>">
                        <div class="invalid-feedback errorFb"></div>
                    </div>
                    <div class="col-lg-4">
                        <label> Youtube :</label><br>
                        <input type="text" name="yt" class="form-control yt" value="<?= $item['yt'] ?>">
                        <div class="invalid-feedback errorYt"></div>
                    </div>
                </div>
                <br>
                <div align="center">
                    <button type="submit" class="btn btn-primary btnEdit">Perbarui</button>
                </div>
                <br>
            </form>
        <?php endforeach ?>
    </div>
</div>

<?= $this->include('backend/konfigurasi/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>