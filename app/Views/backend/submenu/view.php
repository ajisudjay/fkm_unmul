<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Sub Menu : <?= $halaman ?></h4>
        <!-- button tambah modal -->
        <a href="submenu/tambahform?halaman=<?= urlencode($halaman) ?>">
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
                                        <form action="<?= base_url('submenu/editform?halaman=urlencode($halaman)'); ?>" method="post" class="editform">
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