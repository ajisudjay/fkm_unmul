<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\ProdiModel;

use App\Controllers\BaseController;

class Dosen extends BaseController
{
    protected $DosenModel;
    protected $ProdiModel;
    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->ProdiModel = new ProdiModel();
    }
    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                'title' => 'Dosen',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/dosen/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                if (session()->get('level') === 'Dosen') {
                    $data = [
                        'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                        'dosen' => $this->DosenModel->select('dosen.*, users.nama as nama_admin')
                            ->join('users', 'dosen.admin = users.username')
                            ->where('nip', session()->get('username'))->get()->getResultArray(),
                        'akseshapus' => 'hidden',
                        // jumlah pendidikan tendik
                        'jumlahLs1' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs1' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Perempuan')->first(),
                        'jumlahLs2' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs2' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Perempuan')->first(),
                        'jumlahLsp' => $this->DosenModel->selectCount('id')->where('pendidikan', 'Sp')->where('jk', 'Laki-laki')->first(),
                        'jumlahPsp' => $this->DosenModel->selectCount('id')->where('pendidikan', 'Sp')->where('jk', 'Perempuan')->first(),
                        'jumlahLs3' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S3')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs3' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S3')->where('jk', 'Perempuan')->first(),
                        // jumlah jabatan tendik
                        'jumlahLnon' => $this->DosenModel->selectCount('id')->where('jabatan', 'Non Fungsional')->where('jk', 'Laki-laki')->first(),
                        'jumlahLpengajar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Tenaga Pengajar')->where('jk', 'Laki-laki')->first(),
                        'jumlahLasistenahli' => $this->DosenModel->selectCount('id')->where('jabatan', 'Asisten Ahli')->where('jk', 'Laki-laki')->first(),
                        'jumlahLlektor' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor')->where('jk', 'Laki-laki')->first(),
                        'jumlahLlektorkepala' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor Kepala')->where('jk', 'Laki-laki')->first(),
                        'jumlahLgurubesar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Guru Besar')->where('jk', 'Laki-laki')->first(),
                        'jumlahPnon' => $this->DosenModel->selectCount('id')->where('jabatan', 'Non Fungsional')->where('jk', 'Perempuan')->first(),
                        'jumlahPpengajar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Tenaga Pengajar')->where('jk', 'Perempuan')->first(),
                        'jumlahPasistenahli' => $this->DosenModel->selectCount('id')->where('jabatan', 'Asisten Ahli')->where('jk', 'Perempuan')->first(),
                        'jumlahPlektor' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor')->where('jk', 'Perempuan')->first(),
                        'jumlahPlektorkepala' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor Kepala')->where('jk', 'Perempuan')->first(),
                        'jumlahPgurubesar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Guru Besar')->where('jk', 'Perempuan')->first(),

                        'validation' => \Config\Services::validation(),
                    ];
                } else {
                    $data = [
                        'akseshapus' => '',
                        'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                        'dosen' => $this->DosenModel
                            ->select('dosen.*, users.nama as nama_admin')
                            ->join('users', 'dosen.admin = users.username')
                            ->orderBy('nip', 'ASC')->get()->getResultArray(),
                        // jumlah pendidikan tendik
                        'jumlahLs1' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs1' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Perempuan')->first(),
                        'jumlahLs2' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs2' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Perempuan')->first(),
                        'jumlahLsp' => $this->DosenModel->selectCount('id')->where('pendidikan', 'Sp')->where('jk', 'Laki-laki')->first(),
                        'jumlahPsp' => $this->DosenModel->selectCount('id')->where('pendidikan', 'Sp')->where('jk', 'Perempuan')->first(),
                        'jumlahLs3' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S3')->where('jk', 'Laki-laki')->first(),
                        'jumlahPs3' => $this->DosenModel->selectCount('id')->where('pendidikan', 'S3')->where('jk', 'Perempuan')->first(),
                        // jumlah jabatan tendik
                        'jumlahLnon' => $this->DosenModel->selectCount('id')->where('jabatan', 'Non Fungsional')->where('jk', 'Laki-laki')->first(),
                        'jumlahLpengajar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Tenaga Pengajar')->where('jk', 'Laki-laki')->first(),
                        'jumlahLasistenahli' => $this->DosenModel->selectCount('id')->where('jabatan', 'Asisten Ahli')->where('jk', 'Laki-laki')->first(),
                        'jumlahLlektor' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor')->where('jk', 'Laki-laki')->first(),
                        'jumlahLlektorkepala' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor Kepala')->where('jk', 'Laki-laki')->first(),
                        'jumlahLgurubesar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Guru Besar')->where('jk', 'Laki-laki')->first(),
                        'jumlahPnon' => $this->DosenModel->selectCount('id')->where('jabatan', 'Non Fungsional')->where('jk', 'Perempuan')->first(),
                        'jumlahPpengajar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Tenaga Pengajar')->where('jk', 'Perempuan')->first(),
                        'jumlahPasistenahli' => $this->DosenModel->selectCount('id')->where('jabatan', 'Asisten Ahli')->where('jk', 'Perempuan')->first(),
                        'jumlahPlektor' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor')->where('jk', 'Perempuan')->first(),
                        'jumlahPlektorkepala' => $this->DosenModel->selectCount('id')->where('jabatan', 'Lektor Kepala')->where('jk', 'Perempuan')->first(),
                        'jumlahPgurubesar' => $this->DosenModel->selectCount('id')->where('jabatan', 'Guru Besar')->where('jk', 'Perempuan')->first(),

                        'validation' => \Config\Services::validation(),
                    ];
                }

                $msg = [
                    'data' => view('backend/dosen/view', $data)
                ];
                echo json_encode($msg);
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function tambah()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $nip = $request->getVar('nip');
            $nidn = $request->getVar('nidn');
            $nama = $request->getVar('nama');
            $peminatan = $request->getVar('peminatan');
            $pohon = $request->getVar('pohon');
            $cabang = $request->getVar('cabang');
            $bidang = $request->getVar('bidang');
            $homebase = $request->getVar('homebase');
            $jabatan = $request->getVar('jabatan');
            $golongan = $request->getVar('golongan');
            $pangkat = $request->getVar('pangkat');
            $pendidikan = $request->getVar('pendidikan');
            $s1 = $request->getVar('s1');
            $s2 = $request->getVar('s2');
            $s3 = $request->getVar('s3');
            $jk = $request->getVar('jk');
            $tempat_lahir = $request->getVar('tempat_lahir');
            $tanggal_lahir = $request->getVar('tanggal_lahir');
            $alamat = $request->getVar('alamat');
            $telp = $request->getVar('telp');
            $email = $request->getVar('email');
            $sinta = $request->getVar('sinta');
            $gs = $request->getVar('gs');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'nip' => [
                        'label' => 'NIP',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'nidn' => [
                        'label' => 'NIDN',
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'numeric' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'peminatan' => [
                        'label' => 'Peminatan Ilmu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'pohon' => [
                        'label' => 'Pohon Ilmu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'cabang' => [
                        'label' => 'Cabang Ilmu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'bidang' => [
                        'label' => 'Bidang Ilmu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'homebase' => [
                        'label' => 'Homebase',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    's1' => [
                        'label' => 'Asal S1',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    's2' => [
                        'label' => 'Asal S2 / Spesialis',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    's3' => [
                        'label' => 'Asal S3',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'tempat_lahir' => [
                        'label' => 'Tempat Lahir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'tanggal_lahir' => [
                        'label' => 'Tanggal Lahir',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'alamat' => [
                        'label' => 'Alamat',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'telp' => [
                        'label' => 'Telepon',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'email' => [
                        'label' => 'Email',
                        'rules' => 'required|valid_email',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'valid_email' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'sinta' => [
                        'label' => 'Sinta',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'gs' => [
                        'label' => 'Google Scholar',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'file' => [
                        'label' => 'Gambar',
                        'rules' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/png,image/jpeg]|is_image[file]',
                        'errors' => [
                            'uploaded' => '* {field} Tidak Boleh Kosong !',
                            'max_size' => '{field} ukuran lebih dari 1 mb !',
                            'mime_in' => 'Ekstensi tidak sesuai !',
                            'is_image' => 'Ekstensi tidak sesuai !',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'nip' => $validation->getError('nip'),
                            'nidn' => $validation->getError('nidn'),
                            'nama' => $validation->getError('nama'),
                            'peminatan' => $validation->getError('peminatan'),
                            'pohon' => $validation->getError('pohon'),
                            'cabang' => $validation->getError('cabang'),
                            'bidang' => $validation->getError('bidang'),
                            'homebase' => $validation->getError('homebase'),
                            's1' => $validation->getError('s1'),
                            's2' => $validation->getError('s2'),
                            's3' => $validation->getError('s3'),
                            'tempat_lahir' => $validation->getError('tempat_lahir'),
                            'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                            'alamat' => $validation->getError('alamat'),
                            'telp' => $validation->getError('telp'),
                            'email' => $validation->getError('email'),
                            'sinta' => $validation->getError('sinta'),
                            'gs' => $validation->getError('gs'),
                            'file' => $validation->getError('file'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $namagambar = $file->getRandomName();
                    $file->store('content/dosen/', $namagambar);
                    $data = [
                        'nip' => $nip,
                        'nidn' => $nidn,
                        'nama' => $nama,
                        'peminatan' => $peminatan,
                        'pohon' => $pohon,
                        'cabang' => $cabang,
                        'bidang' => $bidang,
                        'homebase' => $homebase,
                        'jabatan' => $jabatan,
                        'golongan' => $golongan,
                        'pangkat' => $pangkat,
                        'pendidikan' => $pendidikan,
                        's1' => $s1,
                        's2' => $s2,
                        's3' => $s3,
                        'jk' => $jk,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'telp' => $telp,
                        'email' => $email,
                        'sinta' => $sinta,
                        'gs' => $gs,
                        'gambar' => $namagambar,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->DosenModel->insert($data);
                    $cekfile = $this->DosenModel->where('gambar', $namagambar)->first();
                    $namafile = $cekfile['gambar'];
                    $filesource = '../writable/uploads/content/dosen/' . $namafile;
                    list($width, $heigth) = getimagesize($filesource);
                    $ratio = $width / $heigth;
                    $max = 500;
                    if ($width > $max || $heigth > $max) {
                        if ($width > $heigth) {
                            $newwidht = round($max);
                            $newheigth = round($max / $ratio);
                        } else {
                            $newheigth = round($max);
                            $newwidht = round($max * $ratio);
                        }
                    } else {
                        $newwidht = round($width);
                        $newheigth = round($heigth);
                    }
                    $thumb = imagecreatetruecolor($newwidht, $newheigth);
                    $exp = explode(".", $namafile);
                    $extension = end($exp);
                    if ($extension == 'png' | $extension == 'PNG') {
                        $source = imagecreatefrompng($filesource);
                    } else {
                        $source = imagecreatefromjpeg($filesource);
                    }

                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidht, $newheigth, $width, $heigth);
                    $target = "../writable/uploads/content/dosen/thumb/$namagambar";
                    imagewebp($thumb, $target, 80);
                    $msg = [
                        'title' => 'Berhasil'
                    ];
                    echo json_encode($msg);
                }
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $validation = \Config\Services::validation();
            $nip = $request->getVar('nip');
            $urutan = $request->getVar('urutan');
            $nidn = $request->getVar('nidn');
            $nama = $request->getVar('nama');
            $bidang = $request->getVar('bidang');
            $homebase = $request->getVar('homebase');
            $jabatan = $request->getVar('jabatan');
            $golongan = $request->getVar('golongan');
            $pangkat = $request->getVar('pangkat');
            $pendidikan = $request->getVar('pendidikan');
            $s1 = $request->getVar('s1');
            $sp = $request->getVar('sp');
            $s2 = $request->getVar('s2');
            $s3 = $request->getVar('s3');
            $jk = $request->getVar('jk');
            $tempat_lahir = $request->getVar('tempat_lahir');
            $tanggal_lahir = $request->getVar('tanggal_lahir');
            $alamat = $request->getVar('alamat');
            $telp = $request->getVar('telp');
            $email = $request->getVar('email');
            $sinta = $request->getVar('sinta');
            $gs = $request->getVar('gs');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'nip' => 'required[nip],',
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/dosen'));
                }
                $data = [
                    'urutan' => $urutan,
                    'nip' => $nip,
                    'nidn' => $nidn,
                    'nama' => $nama,
                    'bidang' => $bidang,
                    'homebase' => $homebase,
                    'jabatan' => $jabatan,
                    'golongan' => $golongan,
                    'pangkat' => $pangkat,
                    'pendidikan' => $pendidikan,
                    's1' => $s1,
                    'sp' => $sp,
                    's2' => $s2,
                    's3' => $s3,
                    'jk' => $jk,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat,
                    'telp' => $telp,
                    'sinta' => $sinta,
                    'gs' => $gs,
                    'email' => $email,
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->DosenModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Dosen');
                return redirect()->to(base_url('/dosen'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/png,image/jpeg]|is_image[file],'
                ]);
                $input2 = $this->validate([
                    'nip' => 'required[nip],',
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
                    return redirect()->to(base_url('/dosen'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/dosen'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->DosenModel->where('id', $id)->first();
                    $namafile = $cekfile['gambar'];
                    $filesource = '../writable/uploads/content/dosen/' . $namafile . '';
                    $filesourcethumb = '../writable/uploads/content/dosen/thumb/' . $namafile . '';
                    chmod($filesource, 0777);
                    chmod($filesourcethumb, 0777);
                    unlink($filesource);
                    unlink($filesourcethumb);
                    $newName = $file->getRandomName();
                    $file->store('content/dosen/', $newName);
                    $nama_foto = $newName;
                    $data = [
                        'urutan' => $urutan,
                        'nip' => $nip,
                        'nidn' => $nidn,
                        'nama' => $nama,
                        'bidang' => $bidang,
                        'homebase' => $homebase,
                        'jabatan' => $jabatan,
                        'golongan' => $golongan,
                        'pangkat' => $pangkat,
                        'pendidikan' => $pendidikan,
                        's1' => $s1,
                        'sp' => $sp,
                        's2' => $s2,
                        's3' => $s3,
                        'jk' => $jk,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'telp' => $telp,
                        'email' => $email,
                        'sinta' => $sinta,
                        'gs' => $gs,
                        'gambar' => $nama_foto,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->DosenModel->update($id, $data);

                    return redirect()->to(base_url("/dosen/thumb/$nama_foto"));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function thumb($namagambar)
    {
        $cekfile = $this->DosenModel->where('gambar', $namagambar)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/dosen/' . $namafile;
        list($width, $heigth) = getimagesize($filesource);
        $ratio = $width / $heigth;
        $max = 500;
        if ($width > $max || $heigth > $max) {
            if ($width > $heigth) {
                $newwidht = round($max);
                $newheigth = round($max / $ratio);
            } else {
                $newheigth = round($max);
                $newwidht = round($max * $ratio);
            }
        } else {
            $newwidht = round($width);
            $newheigth = round($heigth);
        }
        $thumb = imagecreatetruecolor($newwidht, $newheigth);
        $exp = explode(".", $namafile);
        $extension = end($exp);
        if ($extension == 'png' | $extension == 'PNG') {
            $source = imagecreatefrompng($filesource);
        } else {
            $source = imagecreatefromjpeg($filesource);
        }

        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidht, $newheigth, $width, $heigth);
        $target = "../writable/uploads/content/dosen/thumb/$namagambar";
        imagewebp($thumb, $target, 80);
        session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Dosen');
        return redirect()->to(base_url('/dosen'));
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen') {
            $cekfile = $this->DosenModel->where('id', $id)->first();
            $namafile = $cekfile['gambar'];
            $filesource = '../writable/uploads/content/dosen/' . $namafile . '';
            $filesourcethumb = '../writable/uploads/content/dosen/thumb/' . $namafile . '';
            chmod($filesource, 0777);
            chmod($filesourcethumb, 0777);
            unlink($filesource);
            unlink($filesourcethumb);
            $this->DosenModel->delete($id);

            session()->setFlashdata('pesanHapus', 'dihapus !');
            return redirect()->to(base_url('/dosen'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
