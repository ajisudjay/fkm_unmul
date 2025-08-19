<?php

namespace App\Controllers;

use App\Models\TendikModel;
use App\Controllers\BaseController;

class Tendik extends BaseController
{
    protected $TendikModel;
    public function __construct()
    {
        $this->TendikModel = new TendikModel();
    }
    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Tendik') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Tendik',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/tendik/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $data = [
                    'tendik' => $this->TendikModel->select('tendik.*, users.nama as nama_admin')
                        ->join('users', 'tendik.admin = users.username')
                        ->orderBy('nip', 'ASC')->get()->getResultArray(),
                    // jumlah pendidikan tendik
                    'jumlahLsd' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SD')->where('jk', 'Laki-laki')->first(),
                    'jumlahPsd' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SD')->where('jk', 'Perempuan')->first(),
                    'jumlahLsmp' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SMP')->where('jk', 'Laki-laki')->first(),
                    'jumlahPsmp' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SMP')->where('jk', 'Perempuan')->first(),
                    'jumlahLsma' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SMA')->where('jk', 'Laki-laki')->first(),
                    'jumlahPsma' => $this->TendikModel->selectCount('id')->where('pendidikan', 'SMA')->where('jk', 'Perempuan')->first(),
                    'jumlahLd3' => $this->TendikModel->selectCount('id')->where('pendidikan', 'D3')->where('jk', 'Laki-laki')->first(),
                    'jumlahPd3' => $this->TendikModel->selectCount('id')->where('pendidikan', 'D3')->where('jk', 'Perempuan')->first(),
                    'jumlahLd4' => $this->TendikModel->selectCount('id')->where('pendidikan', 'D4')->where('jk', 'Laki-laki')->first(),
                    'jumlahPd4' => $this->TendikModel->selectCount('id')->where('pendidikan', 'D4')->where('jk', 'Perempuan')->first(),
                    'jumlahLs1' => $this->TendikModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Laki-laki')->first(),
                    'jumlahPs1' => $this->TendikModel->selectCount('id')->where('pendidikan', 'S1')->where('jk', 'Perempuan')->first(),
                    'jumlahLs2' => $this->TendikModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Laki-laki')->first(),
                    'jumlahPs2' => $this->TendikModel->selectCount('id')->where('pendidikan', 'S2')->where('jk', 'Perempuan')->first(),
                    // jumlah status tendik
                    'jumlahLnon' => $this->TendikModel->selectCount('id')->where('status', 'Non-ASN')->where('jk', 'Laki-laki')->first(),
                    'jumlahLpns' => $this->TendikModel->selectCount('id')->where('status', 'PNS')->where('jk', 'Laki-laki')->first(),
                    'jumlahLpppk' => $this->TendikModel->selectCount('id')->where('status', 'PPPK')->where('jk', 'Laki-laki')->first(),
                    'jumlahPnon' => $this->TendikModel->selectCount('id')->where('status', 'Non-ASN')->where('jk', 'Perempuan')->first(),
                    'jumlahPpns' => $this->TendikModel->selectCount('id')->where('status', 'PNS')->where('jk', 'Perempuan')->first(),
                    'jumlahPpppk' => $this->TendikModel->selectCount('id')->where('status', 'PPPK')->where('jk', 'Perempuan')->first(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/tendik/view', $data)
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();

            if ($request->isAJAX()) {
                $nip = $request->getVar('nip');
                $nama = $request->getVar('nama');
                $bagian_unit = $request->getVar('bagian_unit');
                $ruangan = $request->getVar('ruangan');
                $jk = $request->getVar('jk');
                $pendidikan = $request->getVar('pendidikan');
                $tempat_lahir = $request->getVar('tempat_lahir');
                $tanggal_lahir = $request->getVar('tanggal_lahir');
                $alamat = $request->getVar('alamat');
                $telp = $request->getVar('telp');
                $email = $request->getVar('email');
                $status = $request->getVar('status');
                $file = $request->getFile('file');
                $username = session()->get('username');
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $timestamp = date("Y-m-d h:i:sa");
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'nip' => [
                        'label' => 'NIP',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',

                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'bagian_unit' => [
                        'label' => 'Bagian Unit',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',

                        ]
                    ],
                    'ruangan' => [
                        'label' => 'Ruangan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',

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
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'email' => [
                        'label' => 'Email',
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
                            'nama' => $validation->getError('nama'),
                            'bagian_unit' => $validation->getError('bagian_unit'),
                            'ruangan' => $validation->getError('ruangan'),
                            'tempat_lahir' => $validation->getError('tempat_lahir'),
                            'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                            'alamat' => $validation->getError('alamat'),
                            'telp' => $validation->getError('telp'),
                            'email' => $validation->getError('email'),
                            'file' => $validation->getError('file'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $namagambar = $file->getRandomName();
                    $file->store('content/tendik/', $namagambar);
                    $data = [
                        'nip' => $nip,
                        'nama' => $nama,
                        'bagian_unit' => $bagian_unit,
                        'ruangan' => $ruangan,
                        'jk' => $jk,
                        'pendidikan' => $pendidikan,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'telp' => $telp,
                        'email' => $email,
                        'status' => $status,
                        'gambar' => $namagambar,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->TendikModel->insert($data);
                    $cekfile = $this->TendikModel->where('gambar', $namagambar)->first();
                    $namafile = $cekfile['gambar'];
                    $filesource = '../writable/uploads/content/tendik/' . $namafile;
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
                    $target = "../writable/uploads/content/tendik/thumb/$namagambar";
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $validation = \Config\Services::validation();
            $nip = $request->getVar('nip');
            $nama = $request->getVar('nama');
            $bagian_unit = $request->getVar('bagian_unit');
            $ruangan = $request->getVar('ruangan');
            $jk = $request->getVar('jk');
            $pendidikan = $request->getVar('pendidikan');
            $tempat_lahir = $request->getVar('tempat_lahir');
            $tanggal_lahir = $request->getVar('tanggal_lahir');
            $alamat = $request->getVar('alamat');
            $telp = $request->getVar('telp');
            $email = $request->getVar('email');
            $status = $request->getVar('status');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'nip' => 'required[nip]|alpha_numeric_punct[nip],',
                    'bagian_unit' => 'required[bagian_unit]|alpha_numeric_punct[bagian_unit],',
                    'ruangan' => 'required[ruangan]|alpha_numeric_punct[ruangan],',
                    'tempat_lahir' => 'required[tempat_lahir]|alpha_numeric_punct[tempat_lahir],',
                    'telp' => 'required[telp]|alpha_numeric_punct[telp],',
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/tendik'));
                }
                $data = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'bagian_unit' => $bagian_unit,
                    'ruangan' => $ruangan,
                    'jk' => $jk,
                    'pendidikan' => $pendidikan,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat,
                    'telp' => $telp,
                    'email' => $email,
                    'status' => $status,
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->TendikModel->update($id, $data);

                $msg = [
                    'title' => 'Berhasil'
                ];
                echo json_encode($msg);
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/png,image/jpeg]|is_image[file],'
                ]);
                $input2 = $this->validate([
                    'nip' => 'required[nip]|alpha_numeric_punct[nip],',
                    'bagian_unit' => 'required[bagian_unit]|alpha_numeric_punct[bagian_unit],',
                    'ruangan' => 'required[ruangan]|alpha_numeric_punct[ruangan],',
                    'tempat_lahir' => 'required[tempat_lahir]|alpha_numeric_punct[tempat_lahir],',
                    'telp' => 'required[telp]|alpha_numeric_punct[telp],',
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
                    return redirect()->to(base_url('/tendik'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/tendik'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->TendikModel->where('id', $id)->first();
                    $namafile = $cekfile['gambar'];
                    $filesource = '../writable/uploads/content/tendik/' . $namafile . '';
                    $filesourcethumb = '../writable/uploads/content/tendik/thumb/' . $namafile . '';
                    chmod($filesource, 0777);
                    chmod($filesourcethumb, 0777);
                    unlink($filesource);
                    unlink($filesourcethumb);
                    $newName = $file->getRandomName();
                    $file->store('content/tendik/', $newName);
                    $nama_foto = $newName;
                    $data = [
                        'nip' => $nip,
                        'nama' => $nama,
                        'bagian_unit' => $bagian_unit,
                        'ruangan' => $ruangan,
                        'jk' => $jk,
                        'pendidikan' => $pendidikan,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'alamat' => $alamat,
                        'telp' => $telp,
                        'email' => $email,
                        'status' => $status,
                        'gambar' => $nama_foto,
                    ];
                    $this->TendikModel->update($id, $data);

                    $cekfile = $this->TendikModel->where('gambar', $nama_foto)->first();
                    $namafile = $cekfile['gambar'];
                    $filesource = '../writable/uploads/content/tendik/' . $namafile;
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
                    $target = "../writable/uploads/content/tendik/thumb/$nama_foto";
                    imagewebp($thumb, $target, 80);
                    $msg = [
                        'title' => 'Berhasil'
                    ];
                    echo json_encode($msg);
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function thumb($namagambar)
    {
        $cekfile = $this->TendikModel->where('gambar', $namagambar)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/tendik/' . $namafile;
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
        $target = "../writable/uploads/content/tendik/thumb/$namagambar";
        imagewebp($thumb, $target, 80);
        session()->setFlashdata('pesanInput', 'Mengubah Data Tendik');
        return redirect()->to(base_url('/tendik'));
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Tendik') {
            $cekfile = $this->TendikModel->where('id', $id)->first();
            $namafile = $cekfile['gambar'];
            $filesource = '../writable/uploads/content/tendik/' . $namafile . '';
            $filesourcethumb = '../writable/uploads/content/tendik/thumb/' . $namafile . '';
            chmod($filesource, 0777);
            chmod($filesourcethumb, 0777);
            unlink($filesource);
            unlink($filesourcethumb);
            $this->TendikModel->delete($id);

            session()->setFlashdata('pesanHapus', 'dihapus !');
            return redirect()->to(base_url('/tendik'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
