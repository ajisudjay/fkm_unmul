<div class="container-fluid">
    <div class="card-header">
        <h4 class="mb-0">Tenaga Pendidik</h4>
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
                    <form action="<?= base_url('dosen/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
                        <?= csrf_field() ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="text-primary">NIP</label>
                                    <input type="text" name="nip" class="form-control nip" placeholder="NIP">
                                    <div class="invalid-feedback errornip"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">NIDN</label>
                                    <input type="text" name="nidn" class="form-control nidn" placeholder="NIDN">
                                    <div class="invalid-feedback errornidn"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control nama" placeholder="Nama">
                                    <div class="invalid-feedback errornama"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                    <div class="invalid-feedback errortempat_lahir"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control tanggal_lahir">
                                    <div class="invalid-feedback errortanggal_lahir"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Jenis Kelamin</label>
                                    <select name="jk" class="form-control jk">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Email</label>
                                    <input type="email" name="email" class="form-control email" placeholder="Email">
                                    <div class="invalid-feedback erroremail"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Alamat</label>
                                    <input type="text" name="alamat" class="form-control alamat" placeholder="Alamat">
                                    <div class="invalid-feedback erroralamat"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Telepon</label>
                                    <input type="text" name="telp" class="form-control telp" placeholder="Telepon">
                                    <div class="invalid-feedback errortelp"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Homebase</label>
                                    <input type="text" name="homebase" class="form-control homebase" placeholder="Homebase">
                                    <div class="invalid-feedback errorhomebase"></div>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Jabatan Fungsional</label>
                                    <select name="jabatan" class="form-control jabatan">
                                        <option value="Non Fungsional">Non Fungsional</option>
                                        <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                        <option value="Asisten Ahli">Asisten Ahli</option>
                                        <option value="Lektor">Lektor</option>
                                        <option value="Lektor Kepala">Lektor Kepala</option>
                                        <option value="Guru Besar">Guru Besar</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Pangkat</label>
                                    <select name="pangkat" class="form-control pangkat">
                                        <option value="Penata Muda">Penata Muda</option>
                                        <option value="Penata Muda Tk. I">Penata Muda Tk. I</option>
                                        <option value="Penata">Penata</option>
                                        <option value="Penata Tk. I">Penata Tk. I</option>
                                        <option value="Pembina">Pembina</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-2">
                                    <label class="text-primary">Golongan</label>
                                    <select name="golongan" class="form-control golongan">
                                        <option value="X">X</option>
                                        <option value="III/b">III/b</option>
                                        <option value="III/c">III/c</option>
                                        <option value="III/d">III/d</option>
                                        <option value="IV/a">IV/a</option>
                                        <option value="IV/b">IV/b</option>
                                        <option value="IV/c">IV/c</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Sinta</label>
                                    <input type="text" name="sinta" class="form-control sinta" placeholder="Sinta">
                                    <div class="invalid-feedback errorsinta"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Google Scholar</label>
                                    <input type="text" name="gs" class="form-control gs" placeholder="Google Scholar">
                                    <div class="invalid-feedback errorgs"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Pendidikan Terakhir</label>
                                    <select name="pendidikan" class="form-control pendidikan">
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Asal S1</label>
                                    <input type="text" name="s1" class="form-control s1" placeholder="Asal S1">
                                    <div class="invalid-feedback errors1"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Asal S2</label>
                                    <input type="text" name="s2" class="form-control s2" placeholder="Asal S2">
                                    <div class="invalid-feedback errors2"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Asal S3</label>
                                    <input type="text" name="s3" class="form-control s3" placeholder="Asal S3">
                                    <div class="invalid-feedback errors3"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Peminatan</label>
                                    <select name="peminatan" class="form-control peminatan">
                                        <option value="Administrasi & Kebijakan Kesehatan">Administrasi & Kebijakan Kesehatan</option>
                                        <option value="Biostatistik & Kependudukan">Biostatistik & Kependudukan</option>
                                        <option value="Epidemiologi">Epidemiologi</option>
                                        <option value="Gizi">Gizi</option>
                                        <option value="Kesehatan & Keselamatan Kerja">Kesehatan & Keselamatan Kerja</option>
                                        <option value="Kesehatan Lingkungan">Kesehatan Lingkungan</option>
                                        <option value="Promosi Kesehatan">Promosi Kesehatan</option>
                                        <option value="-">-</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Pohon Ilmu</label>
                                    <input type="text" required name="pohon" class="form-control pohon" placeholder="Pohon Ilmu">
                                    <div class="invalid-feedback errorpohon"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Cabang Ilmu</label>
                                    <input type="text" required name="cabang" class="form-control cabang" placeholder="Cabang Ilmu">
                                    <div class="invalid-feedback errorcabang"></div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-primary">Bidang Ilmu</label>
                                    <input type="text" required name="bidang" class="form-control bidang" placeholder="Bidang Ilmu">
                                    <div class="invalid-feedback errorbidang"></div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-primary">Foto<span style="color: red;">*Max-Size : 1 mb | extension : jpg/jpeg/png/PNG</span></label>
                                    <input type="file" name="file" class="form-control file" accept="image/*">
                                    <div class="invalid-feedback errorfile"></div>
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
        <div class="card">
            <div class="row">
                <div class="col-lg-7">
                    <h6>Berdasarkan Jabatan Fungsional</h6>
                    <div class="dt-responsive table-responsive">
                        <table class="table table-striped table-hover">
                            <thead align="center">
                                <tr>
                                    <th width="10%">Jenis Kelamin</th>
                                    <th width="5%">Non Fungsional</th>
                                    <th width="5%">Tenaga Pengajar</th>
                                    <th width="5%">Asisten Ahli</th>
                                    <th width="5%">Lektor</th>
                                    <th width="5%">Lektor Kepala</th>
                                    <th width="5%">Guru Besar</th>
                                    <th width="5%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 13px;" align="center">
                                <tr>
                                    <td>L</td>
                                    <td><?= $jumlahLnon['id'] ?></td>
                                    <td><?= $jumlahLpengajar['id'] ?></td>
                                    <td><?= $jumlahLasistenahli['id'] ?></td>
                                    <td><?= $jumlahLlektor['id'] ?></td>
                                    <td><?= $jumlahLlektorkepala['id'] ?></td>
                                    <td><?= $jumlahLgurubesar['id'] ?></td>
                                    <?php
                                    $jumlahlakijabatan = $jumlahLnon['id'] + $jumlahLpengajar['id'] + $jumlahLasistenahli['id'] + $jumlahLlektor['id'] + $jumlahLlektorkepala['id'] + $jumlahLgurubesar['id'];
                                    ?>
                                    <td><b><?= $jumlahlakijabatan; ?></b></td>

                                </tr>
                                <tr>
                                    <td>P</td>
                                    <td><?= $jumlahPnon['id'] ?></td>
                                    <td><?= $jumlahPpengajar['id'] ?></td>
                                    <td><?= $jumlahPasistenahli['id'] ?></td>
                                    <td><?= $jumlahPlektor['id'] ?></td>
                                    <td><?= $jumlahPlektorkepala['id'] ?></td>
                                    <td><?= $jumlahPgurubesar['id'] ?></td>
                                    <?php
                                    $jumlahperempuanjabatan = $jumlahPnon['id'] + $jumlahPpengajar['id'] + $jumlahPasistenahli['id'] + $jumlahPlektor['id'] + $jumlahPlektorkepala['id'] + $jumlahPgurubesar['id'];
                                    ?>
                                    <td><b><?= $jumlahperempuanjabatan; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right"><b>Jumlah</b></td>
                                    <td><b><?= $jumlahlakijabatan + $jumlahperempuanjabatan; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h6>Berdasarkan Pendidikan Terakhir</h6>
                    <div class="dt-responsive table-responsive">
                        <table class="table table-striped table-hover">
                            <thead align="center">
                                <tr>
                                    <th width="5%">Jenis Kelamin</th>
                                    <th width="5%">S1</th>
                                    <th width="5%">S2</th>
                                    <th width="5%">Sp</th>
                                    <th width="5%">S3</th>
                                    <th width="5%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 13px;" align="center">
                                <tr>
                                    <td>L</td>
                                    <td><?= $jumlahLs1['id'] ?></td>
                                    <td><?= $jumlahLs2['id'] ?></td>
                                    <td><?= $jumlahLsp['id'] ?></td>
                                    <td><?= $jumlahLs3['id'] ?></td>
                                    <?php
                                    $jumlahlakipendidikan = $jumlahLs1['id'] + $jumlahLs2['id'] + $jumlahLsp['id'] + $jumlahLs3['id'];
                                    ?>
                                    <td><b><?= $jumlahlakipendidikan; ?></b></td>

                                </tr>
                                <tr>
                                    <td>P</td>
                                    <td><?= $jumlahPs1['id'] ?></td>
                                    <td><?= $jumlahPs2['id'] ?></td>
                                    <td><?= $jumlahPsp['id'] ?></td>
                                    <td><?= $jumlahPs3['id'] ?></td>
                                    <?php
                                    $jumlahperempuanpendidikan = $jumlahPs2['id'] + $jumlahPsp['id'] + $jumlahPs3['id'];
                                    ?>
                                    <td><b><?= $jumlahperempuanpendidikan; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Jumlah</b></td>
                                    <td><b><?= $jumlahlakipendidikan + $jumlahperempuanpendidikan; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-block">
        <table id="simpletable" class="table table-striped table-hover-animation nowrap">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="5%" style="text-align: center;">AKSI</th>
                    <th width="20%">NIP</th>
                    <th width="30%">NAMA</th>
                    <th width="10%">BAGIAN UNIT</th>
                    <th width="10%">PEND.</th>
                    <th width="10%" style="text-align: center;">FOTO</th>
                    <th width="10%">LOG</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($dosen as $item) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <!-- ISI VIEW -->
                        <td style="text-align: center;">
                            <button type="button" class="btn-sm btn-primary border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                                <span class="feather icon-edit-1 text-default"></span>
                            </button>
                            <!-- edit modal-->
                            <div class="modal fade" id="editmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ubah</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('dosen/edit'); ?>" enctype="multipart/form-data" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-body" style="text-align: left;">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <input name="id" value="<?= $item['id'] ?>" hidden>
                                                            <label class="text-primary">NIP</label>
                                                            <input type="text" required name="nip" class="form-control nip" value="<?= $item['nip'] ?>">
                                                            <div class="invalid-feedback errornip"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">NIDN</label>
                                                            <input type="text" required name="nidn" class="form-control nidn" value="<?= $item['nidn'] ?>">
                                                            <div class="invalid-feedback errornidn"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Nama</label>
                                                            <input type="text" required name="nama" class="form-control nama" value="<?= $item['nama'] ?>">
                                                            <div class="invalid-feedback errornama"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Tempat Lahir</label>
                                                            <input type="text" required name="tempat_lahir" class="form-control tempat_lahir" value="<?= $item['tempat_lahir'] ?>">
                                                            <div class="invalid-feedback errortempat_lahir"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Tanggal Lahir</label>
                                                            <input type="date" required name="tanggal_lahir" class="form-control tanggal_lahir" value="<?= $item['tanggal_lahir'] ?>">
                                                            <div class="invalid-feedback errortanggal_lahir"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Jenis Kelamin</label>
                                                            <select name="jk" class="form-control jk">
                                                                <option value="<?= $item['jk'] ?>"><?= $item['jk'] ?></option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Email</label>
                                                            <input type="email" required name="email" class="form-control email" value="<?= $item['email'] ?>">
                                                            <div class="invalid-feedback erroremail"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Alamat</label>
                                                            <input type="text" required name="alamat" class="form-control alamat" value="<?= $item['alamat'] ?>">
                                                            <div class="invalid-feedback erroralamat"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Telepon</label>
                                                            <input type="text" required name="telp" class="form-control telp" value="<?= $item['telp'] ?>">
                                                            <div class="invalid-feedback errortelp"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Homebase</label>
                                                            <input type="text" required name="homebase" class="form-control homebase" value="<?= $item['homebase'] ?>">
                                                            <div class="invalid-feedback errorhomebase"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Jabatan Fungsional</label>
                                                            <select name="jabatan" class="form-control jabatan">
                                                                <option value="<?= $item['jabatan'] ?>"><?= $item['jabatan'] ?></option>
                                                                <option value="Non Fungsional">Non Fungsional</option>
                                                                <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                                                <option value="Asisten Ahli">Asisten Ahli</option>
                                                                <option value="Lektor">Lektor</option>
                                                                <option value="Lektor Kepala">Lektor Kepala</option>
                                                                <option value="Guru Besar">Guru Besar</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Pangkat</label>
                                                            <select name="pangkat" class="form-control pangkat">
                                                                <option value="<?= $item['pangkat'] ?>"><?= $item['pangkat'] ?></option>
                                                                <option value="Penata Muda">Penata Muda</option>
                                                                <option value="Penata Muda Tk. I">Penata Muda Tk. I</option>
                                                                <option value="Penata">Penata</option>
                                                                <option value="Penata Tk. I">Penata Tk. I</option>
                                                                <option value="Pembina">Pembina</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <label class="text-primary">Golongan</label>
                                                            <select name="golongan" class="form-control golongan">
                                                                <option value="<?= $item['golongan'] ?>"><?= $item['golongan'] ?></option>
                                                                <option value="X">X</option>
                                                                <option value="III/b">III/b</option>
                                                                <option value="III/c">III/c</option>
                                                                <option value="III/d">III/d</option>
                                                                <option value="IV/a">IV/a</option>
                                                                <option value="IV/b">IV/b</option>
                                                                <option value="IV/c">IV/c</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Sinta</label>
                                                            <input type="text" name="sinta" class="form-control sinta" value="<?= $item['sinta'] ?>">
                                                            <div class="invalid-feedback errorsinta"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Google Scholar</label>
                                                            <input type="text" name="gs" class="form-control gs" value="<?= $item['gs'] ?>">
                                                            <div class="invalid-feedback errorgs"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label class="text-primary">Pendidikan Terakhir</label>
                                                            <select name="pendidikan" class="form-control pendidikan">
                                                                <option value="<?= $item['pendidikan'] ?>"><?= $item['pendidikan'] ?></option>
                                                                <option value="S2">S2</option>
                                                                <option value="S3">S3</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Asal S1</label>
                                                            <input type="text" required name="s1" class="form-control s1" value="<?= $item['s1'] ?>">
                                                            <div class="invalid-feedback errors1"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Asal S2</label>
                                                            <input type="text" required name="s2" class="form-control s2" value="<?= $item['s2'] ?>">
                                                            <div class="invalid-feedback errors2"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Asal S3</label>
                                                            <input type="text" required name="s3" class="form-control s3" value="<?= $item['s3'] ?>">
                                                            <div class="invalid-feedback errors3"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Peminatan</label>
                                                            <select name="peminatan" class="form-control peminatan">
                                                                <option value="<?= $item['peminatan'] ?>"><?= $item['peminatan'] ?></option>
                                                                <option value="Administrasi & Kebijakan Kesehatan">Administrasi & Kebijakan Kesehatan</option>
                                                                <option value="Biostatistik & Kependudukan">Biostatistik & Kependudukan</option>
                                                                <option value="Epidemiologi">Epidemiologi</option>
                                                                <option value="Gizi">Gizi</option>
                                                                <option value="Kesehatan & Keselamatan Kerja">Kesehatan & Keselamatan Kerja</option>
                                                                <option value="Kesehatan Lingkungan">Kesehatan Lingkungan</option>
                                                                <option value="Promosi Kesehatan">Promosi Kesehatan</option>
                                                                <option value="-">-</option>
                                                            </select>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Pohon Ilmu</label>
                                                            <input type="text" required name="pohon" class="form-control pohon" value="<?= $item['pohon'] ?>">
                                                            <div class="invalid-feedback errorpohon"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Cabang Ilmu</label>
                                                            <input type="text" required name="cabang" class="form-control cabang" value="<?= $item['cabang'] ?>">
                                                            <div class="invalid-feedback errorcabang"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="text-primary">Bidang Ilmu</label>
                                                            <input type="text" required name="bidang" class="form-control bidang" value="<?= $item['bidang'] ?>">
                                                            <div class="invalid-feedback errorbidang"></div>
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <img src="<?= base_url('writable/uploads/content/dosen/thumb/' . $item['gambar'] . ''); ?>" width="125px"><br>
                                                            <label class="text-primary">Foto<span style="color: red;">*Max-Size : 1 mb | extension : jpg/jpeg/png/PNG</span></label></label>
                                                            <input type="file" name="file" class="form-control file" accept="image/*">
                                                            <div class="invalid-feedback errorfile"></div>
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
                            <a href="<?= base_url('dosen/hapus/' . $item['id']); ?>" class="hapus">
                                <span class="btn-sm btn-danger feather icon-trash-2 text-default"></span>
                            </a>
                        <td><?= $item['nip'] ?></td>
                        <td style="min-width: 150px;max-width: 200px; white-space: normal;"><?= $item['nama'] ?></td>
                        <td style="min-width: 100px;max-width: 200px; white-space: normal;"><?= $item['bidang'] ?></td>
                        <td style="min-width: 25px;max-width: 50px; white-space: normal;"><?= $item['pendidikan'] ?></td>
                        <td style=";text-align: center;"><img src="<?= base_url('writable/uploads/content/dosen/thumb/' . $item['gambar'] . ''); ?>" width="100px"></td>
                        <td><?= $item['timestamp'] . ' | ' . $item['admin'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<?= $this->include('backend/dosen/ajax') ?>
<?= $this->include('backend/layouts/js_view') ?>