<?php

namespace App\Controllers;

use App\Models\S_keluarModel;
use App\Models\Kode_suratModel;
use App\Models\UsersModel;
use App\Controllers\BaseController;

class S_keluar extends BaseController
{
    protected $S_keluarModel;
    protected $Kode_suratModel;
    protected $UsersModel;
    public function __construct()
    {
        $this->S_keluarModel = new S_keluarModel();
        $this->Kode_suratModel = new Kode_suratModel();
        $this->UsersModel = new UsersModel();
    }
    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen' || session()->get('level') === 'Tendik') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            $namaadmin = session()->get('username');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            if (session()->get('level') === 'Admin eOffice') {
                $data = [
                    'title' => 'Surat Keluar',
                    'admin' => $admin,
                    'lvl' => $lvl,
                    'foto' => $gambar,
                    'tahun_surat' => $this->S_keluarModel->DISTINCT('tahun')->getDistinctYears()
                ];
            } else {
                $data = [
                    'title' => 'Surat Keluar',
                    'admin' => $admin,
                    'lvl' => $lvl,
                    'foto' => $gambar,
                    'tahun_surat' => $this->S_keluarModel->where('admin', $namaadmin)->DISTINCT('tahun')->getDistinctYears()
                ];
            }
            return view('backend/s_keluar/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();
            $namaadmin = session()->get('username');
            if ($request->isAJAX()) {
                $tahun = $request->getVar('tahun');
                if (session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Superadmin') {
                    $data = [
                        'tahun' => $tahun,
                        'akses' => '',
                        'namaadminx' => $this->UsersModel->get()->getResultArray(),
                        's_keluar' => $this->S_keluarModel->where('YEAR(tanggal)', $tahun)->orderBy('perihal', 'ASC')->get()->getResultArray(),
                        'kode_surat' => $this->Kode_suratModel->orderBy('kode_surat', 'ASC')->get()->getResultArray(),
                        'nomor_terakhir' => $this->S_keluarModel->where('YEAR(tanggal)', $tahun)->orderBy('nomor', 'DESC')->first(),
                        'validation' => \Config\Services::validation(),
                    ];
                } else {
                    $data = [
                        'tahun' => $tahun,
                        'akses' => 'readonly',
                        'namaadminx' => $this->UsersModel->get()->getResultArray(),
                        's_keluar' => $this->S_keluarModel->where('YEAR(tanggal)', $tahun)->where('admin', $namaadmin)->findAll(),
                        'kode_surat' => $this->Kode_suratModel->orderBy('kode_surat', 'ASC')->get()->getResultArray(),
                        'nomor_terakhir' => $this->S_keluarModel->where('YEAR(tanggal)', $tahun)->orderBy('nomor', 'DESC')->first(),
                        'validation' => \Config\Services::validation(),
                    ];
                }
                $msg = [
                    'data' => view('backend/s_keluar/view', $data)
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $kode_surat = $request->getVar('kode_surat');
            $tanggal = $request->getVar('tanggal');
            $perihal = $request->getVar('perihal');
            $file = $request->getFile('file');
            $bagian = $request->getVar('bagian');
            $username = session()->get('username');
            $tujuan = $request->getVar('tujuan');
            $jalur = $request->getVar('jalur');
            $keterangan = $request->getVar('keterangan');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'tanggal' => [
                        'label' => 'Tanggal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'perihal' => [
                        'label' => 'Perihal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'tujuan' => [
                        'label' => 'Tujuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'bagian' => [
                        'label' => 'Bagian',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'keterangan' => [
                        'label' => 'Keterangan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'file' => [
                        'label' => 'File',
                        'rules' => 'uploaded[file]|max_size[file,5012]',
                        'errors' => [
                            'uploaded' => '* {field} Tidak Boleh Kosong !',
                            'max_size' => '{field} ukuran lebih dari 5 mb !',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'tanggal' => $validation->getError('tanggal'),
                            'perihal' => $validation->getError('perihal'),
                            'tujuan' => $validation->getError('tujuan'),
                            'bagian' => $validation->getError('bagian'),
                            'keterangan' => $validation->getError('keterangan'),
                            'file' => $validation->getError('file'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $newName = $file->getRandomName();
                    $file->store('content/s_keluar/', $newName);
                    $nama_file = $newName;
                    $data = [
                        'kode_surat' => $kode_surat,
                        'jalur' => $jalur,
                        'tanggal' => $tanggal,
                        'perihal' => $perihal,
                        'tujuan' => $tujuan,
                        'file' => $nama_file,
                        'bagian' => $bagian,
                        'keterangan' => $keterangan,
                        'status' => 'usulan',
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->S_keluarModel->insert($data);

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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen' || session()->get('level') === 'Tendik') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $nomor = $request->getVar('nomor');
            $kode_surat = $request->getVar('kode_surat');
            $tanggal = $request->getVar('tanggal');
            $perihal = $request->getVar('perihal');
            $file = $request->getFile('file');
            $bagian = $request->getVar('bagian');
            $username = session()->get('username');
            $tujuan = $request->getVar('tujuan');
            $jalur = $request->getVar('jalur');
            $status = $request->getVar('status');
            $keterangan = $request->getVar('keterangan');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                    'tujuan' => 'required[tujuan],',
                    'bagian' => 'required[bagian],',
                    'keterangan' => 'required[keterangan],'
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                }
                if (session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Superadmin') {
                    $data = [
                        'nomor' => $nomor,
                        'kode_surat' => $kode_surat,
                        'jalur' => $jalur,
                        'tanggal' => $tanggal,
                        'perihal' => $perihal,
                        'tujuan' => $tujuan,
                        'status' => $status,
                        'keterangan' => $keterangan,
                        'bagian' => $bagian,
                        'admin2' => $username,
                        'timestamp2' => $timestamp,
                    ];
                } else {
                    $data = [
                        'nomor' => $nomor,
                        'kode_surat' => $kode_surat,
                        'jalur' => $jalur,
                        'tanggal' => $tanggal,
                        'perihal' => $perihal,
                        'tujuan' => $tujuan,
                        'status' => 'usulan',
                        'keterangan' => $keterangan,
                        'bagian' => $bagian,
                        'admin2' => $username,
                        'timestamp2' => $timestamp,
                    ];
                }
                $this->S_keluarModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Mengubah Data Surat Keluar');
                return redirect()->to(base_url('/s_keluar'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,5048],'

                ]);
                $input2 = $this->validate([
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                    'tujuan' => 'required[tujuan],',
                    'bagian' => 'required[bagian],',
                    'keterangan' => 'required[keterangan],'
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format Dokumen tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->S_keluarModel->where('id', $id)->first();
                    $namafile = $cekfile['file'];
                    $filesource = '../writable/uploads/content/s_keluar/' . $namafile . '';
                    chmod($filesource, 0777);
                    unlink($filesource);
                    $newName = $file->getRandomName();
                    $file->store('content/s_keluar/', $newName);
                    $nama_file = $newName;
                    if (session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Superadmin') {
                        $data = [
                            'nomor' => $nomor,
                            'kode_surat' => $kode_surat,
                            'jalur' => $jalur,
                            'tanggal' => $tanggal,
                            'perihal' => $perihal,
                            'tujuan' => $tujuan,
                            'status' => $status,
                            'keterangan' => $keterangan,
                            'bagian' => $bagian,
                            'admin2' => $username,
                            'timestamps2' => $timestamp,
                            'file' => $nama_file,
                        ];
                    } else {
                        $data = [
                            'kode_surat' => $kode_surat,
                            'jalur' => $jalur,
                            'tanggal' => $tanggal,
                            'perihal' => $perihal,
                            'tujuan' => $tujuan,
                            'status' => 'usulan',
                            'keterangan' => $keterangan,
                            'bagian' => $bagian,
                            'admin2' => $username,
                            'timestamps2' => $timestamp,
                            'file' => $nama_file,
                        ];
                    }
                    $this->S_keluarModel->update($id, $data);
                    session()->setFlashdata('pesanInput', 'Mengubah Data Surat Keluar');
                    return redirect()->to(base_url('/s_keluar'));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice' || session()->get('level') === 'Dosen' || session()->get('level') === 'Tendik') {
            $cekfile = $this->S_keluarModel->where('id', $id)->first();
            $namafile = $cekfile['file'];
            $filesource = '../writable/uploads/content/s_keluar/' . $namafile . '';
            chmod($filesource, 0777);
            unlink($filesource);
            $this->S_keluarModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/s_keluar'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
