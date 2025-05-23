<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Surat Keluar : <?= $tahun ?></h4>
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
                    <h5 class="modal-title">Pengajuan Surat Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('s_keluar/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <?php
                                if ($akses == 'readonly') { ?>

                                <?php } else { ?>
                                    <div class="col-lg-3">
                                        <label class="text-primary">Nomor Surat</label>
                                        <input type="text" name="nomor" class="form-control nomor" placeholder="Nomor">
                                        <div class="invalid-feedback errornomor"></div>
                                        <br>
                                    </div>
                                <?php }
                                ?>

                                <div class="col-lg-4">
                                    <label class="text-primary">Kode Surat</label>
                                    <select name="kode_surat" class="form-control kode_surat">
                                        <?php foreach ($kode_surat as $item2) : ?>
                                            <option value="<?= $item2['kode_surat'] ?>"><?= $item2['kode_surat'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Jalur</label>
                                    <select name="jalur" class="form-control jalur">
                                        <option value="TU">TU</option>
                                        <option value="Mandiri">Mandiri</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal">
                                    <div class="invalid-feedback errortanggal"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Perihal</label>
                                    <input type="text" name="perihal" class="form-control perihal" placeholder="Perihal">
                                    <div class="invalid-feedback errorperihal"></div>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-primary">Tujuan</label>
                                    <input type="text" name="tujuan" class="form-control tujuan" placeholder="Tujuan">
                                    <div class="invalid-feedback errortujuan"></div>
                                    <br>
                                </div>
                                <br>
                                <div class="col-lg-4">
                                    <label class="text-primary">File <span style="color: red;">*max size 5mb</span></label>
                                    <input type="file" name="file" class="form-control file">
                                    <div class="invalid-feedback errorfile"></div>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-primary">Bagian</label>
                                    <input type="text" name="bagian" class="form-control bagian" placeholder="Bagian">
                                    <div class="invalid-feedback errorbagian"></div>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-primary">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control keterangan" value="-">
                                    <div class="invalid-feedback errorketerangan"></div>
                                    <br>
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
                        <th width="5%">Nomor</th>
                        <th width="10%">Kode</th>
                        <th width="10%">Tanggal</th>
                        <th width="35%">Perihal</th>
                        <th width="25%">Tujuan</th>
                        <th width="15%" style="text-align: center;">Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($s_keluar as $item) : ?>
                        <tr>
                            <!-- ISI VIEW -->
                            <td>
                                <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#fileusulanmodal<?= $id = $item['id'] ?>">
                                    <?= $item['nomor']; ?>
                                </button>
                            </td>
                            <td>
                                <?php $tahunsurat = date('Y', strtotime($item['tanggal'])); ?>
                                <?= $item['kode_surat'] . $tahunsurat; ?>
                            </td>
                            <td>
                                <?= $item['tanggal'] ?>
                                <!-- usulan modal-->
                                <div class="modal fade" id="fileusulanmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title">Surat Keluar : <?= $item['perihal'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="text-align:left ;">
                                                <div class="row">
                                                    <form action="<?= base_url('s_keluar/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="text-primary">Nomor Surat </label><span style="font-size: x-small;">*: <?= $nomor_terakhir['nomor'] ?></span>
                                                                    <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                                                    <input type="text" name="nomor" class="form-control nomor" value="<?= $item['nomor'] ?>" <?= $akses ?>>
                                                                    <div class="invalid-feedback errornomor"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label class="text-primary">Kode Surat</label>
                                                                    <select name="kode_surat" class="form-control kode_surat">
                                                                        <option value="<?= $item['kode_surat'] ?>"><?= $item['kode_surat'] ?></option>
                                                                        <?php foreach ($kode_surat as $item2) : ?>
                                                                            <option value="<?= $item2['kode_surat'] ?>"><?= $item2['kode_surat'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label class="text-primary">Jalur</label>
                                                                    <select name="jalur" class="form-control jalur">
                                                                        <option value="<?= $item['jalur'] ?>"><?= $item['jalur'] ?></option>
                                                                        <option value="TU">TU</option>
                                                                        <option value="Mandiri">Mandiri</option>
                                                                    </select>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label class="text-primary">Tanggal</label>
                                                                    <input type="date" name="tanggal" class="form-control tanggal" value="<?= $item['tanggal'] ?>">
                                                                    <div class="invalid-feedback errortanggal"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <label class="text-primary">Perihal</label>
                                                                    <input type="text" name="perihal" class="form-control perihal" value="<?= $item['perihal'] ?>" required>
                                                                    <div class="invalid-feedback errorperihal"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <label class="text-primary">Tujuan</label>
                                                                    <input type="text" name="tujuan" class="form-control tujuan" value="<?= $item['tujuan'] ?>" required>
                                                                    <div class="invalid-feedback errortujuan"></div>
                                                                    <br>
                                                                </div>
                                                                <br>

                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Bagian</label>
                                                                    <input type="text" name="bagian" class="form-control bagian" value="<?= $item['bagian'] ?>" required>
                                                                    <div class="invalid-feedback errorbagian"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Keterangan</label>
                                                                    <input type="text" name="keterangan" class="form-control keterangan" value="<?= $item['keterangan'] ?>" required>
                                                                    <div class="invalid-feedback errorketerangan"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Status</label>
                                                                    <select name="status" class="form-control status" <?= $akses ?>>
                                                                        <option value="<?= $item['status'] ?>"><?= $item['status'] ?></option>
                                                                        <option value="usulan">usulan</option>
                                                                        <option value="ditolak">ditolak</option>
                                                                        <option value="diproses">diproses</option>
                                                                        <option value="selesai">selesai</option>
                                                                    </select>
                                                                    <div class="invalid-feedback errorstatus"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Ganti File <span style="color: red;">*max size 5mb</span></label>
                                                                    <input type="file" name="file" class="form-control file">
                                                                    <div class="invalid-feedback errorfile"></div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td style="min-width: 200px;max-width: 400px; white-space: normal;"><?= $item['perihal'] ?>
                                <button type="button" class="btn-sm btn-success border-0" data-toggle="modal" data-target="#fileviewmodal<?= $id = $item['id'] ?>">
                                    <span class="fa fa-download"></span>
                                </button>
                                <!-- view modal-->
                                <div class="modal fade" id="fileviewmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title">Surat Keluar : <?= $item['perihal'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body" style="text-align:left ;">
                                                    <div class="row">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <embed src="<?= base_url('writable/uploads/content/s_keluar/' . $item['file']) ?>" type='application/pdf' width='100%' height='400px'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="min-width: 150px;max-width: 450px; white-space: normal;"><?= $item['tujuan'] ?></td>
                            <td style="text-align: center;">
                                <span class="badge badge-pill badge-primary"><?= $item['status'] ?></span>
                                <?php
                                $admin1 = '-'; // Reset admin1
                                $admin2 = '-'; // Reset admin2
                                ?>
                                <?php foreach ($namaadminx as $x) : ?>
                                    <?php if ($x['username'] == $item['admin']) : ?>
                                        <?php $admin1 = $x['nama'] ?>
                                    <?php endif; ?>
                                    <?php if ($x['username'] == $item['admin2']) : ?>
                                        <?php $admin2 = $x['nama'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <button type="button" class="badge badge-pill badge-info" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-content="Dibuat :<br> <?= $item['timestamp'] ?> -  <?= $admin1 ?><br> Diproses :<br> <?= $item['timestamp2'] ?> - <?= $admin2 ?> ">
                                    <span class="fa fa-history"></span>
                                </button>
                                <button class="badge badge-pill badge-danger" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-trash"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- button hapus modal-->
                                    <a href="<?= base_url('s_keluar/hapus/' . $item['id']); ?>" class="dropdown-item hapus">
                                        <span class="fa fa-trash text-danger"> Hapus</span>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->include('backend/s_keluar/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>