<?php

namespace App\Controllers;

use App\Models\SkModel;
use App\Models\Kategori_skModel;
use App\Models\SemesterModel;
use App\Controllers\BaseController;

class Sk extends BaseController
{
    protected $SkModel;
    protected $Kategori_skModel;
    protected $SemesterModel;
    public function __construct()
    {
        $this->SkModel = new SkModel();
        $this->Kategori_skModel = new Kategori_skModel();
        $this->SemesterModel = new SemesterModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Surat Keputusan',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/sk/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $username = session()->get('username');
            if ($request->isAJAX()) {
                $data = [
                    'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->select('*')->select('sk.id as id_sk')->select('kategori_sk.kategori as nama_kategori')->select('semester.semester as nama_semester')->join('kategori_sk', 'kategori_sk.id=sk.kategori')->join('semester', 'semester.id=sk.semester')->get()->getResultArray(),
                    'kategori_sk' => $this->Kategori_skModel->orderBy('kategori', 'ASC')->get()->getResultArray(),
                    'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/sk/view', $data)
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
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin' || session()->get('level') === 'Enum') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $nomor = $request->getVar('nomor');
            $jenis = $request->getVar('jenis');
            $tanggal = $request->getVar('tanggal');
            $kategori = $request->getVar('kategori');
            $semester = $request->getVar('semester');
            $perihal = $request->getVar('perihal');
            $sasaran = $request->getVar('sasaran');
            $file = $request->getFile('file');
            $admin = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");

            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'jenis' => [
                        'label' => 'Jenis',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'nomor' => [
                        'label' => 'Nomor',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'tanggal' => [
                        'label' => 'Tanggal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'sasaran' => [
                        'label' => 'Sasaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'perihal' => [
                        'label' => 'Perihal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'file' => [
                        'label' => 'File',
                        'rules' => 'uploaded[file]|max_size[file,50480]',
                        'errors' => [
                            'uploaded' => '{field} Tidak Boleh Kosong',
                            'max_size' => '{field} Ukuran File Lebih 5mb',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'jenis' => $validation->getError('jenis'),
                            'nomor' => $validation->getError('nomor'),
                            'tanggal' => $validation->getError('tanggal'),
                            'sasaran' => $validation->getError('sasaran'),
                            'perihal' => $validation->getError('perihal'),
                            'file' => $validation->getError('file'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $newName = $file->getRandomName();
                    $file->store('content/sk/', $newName);
                    $data = [
                        'nomor' => $nomor,
                        'jenis' => $jenis,
                        'tanggal' => $tanggal,
                        'kategori' => $kategori,
                        'semester' => $semester,
                        'perihal' => $perihal,
                        'sasaran' => $sasaran,
                        'file' => $newName,
                        'admin' => $admin,
                        'timestamps' => $timestamp,
                    ];
                    $this->SkModel->insert($data);

                    $data2 = [
                        'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->select('*')->select('sk.id as id_sk')->select('kategori_sk.kategori as nama_kategori')->select('semester.semester as nama_semester')->join('kategori_sk', 'kategori_sk.id=sk.kategori')->join('semester', 'semester.id=sk.semester')->get()->getResultArray(),
                        'kategori_sk' => $this->Kategori_skModel->orderBy('kategori', 'ASC')->get()->getResultArray(),
                        'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
                        'validation' => \Config\Services::validation(),
                    ];
                    $msg = [
                        'data' => view('backend/sk/view', $data2)
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
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin' || session()->get('level') === 'Enum') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $id = $request->getVar('id');
            $nomor = $request->getVar('nomor');
            $jenis = $request->getVar('jenis');
            $tanggal = $request->getVar('tanggal');
            $kategori = $request->getVar('kategori');
            $semester = $request->getVar('semester');
            $perihal = $request->getVar('perihal');
            $sasaran = $request->getVar('sasaran');
            $file = $request->getFile('file');
            $admin = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");

            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'nomor' => 'required[nomor],',
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/sk'));
                }
                $data = [
                    'nomor' => $nomor,
                    'jenis' => $jenis,
                    'tanggal' => $tanggal,
                    'kategori' => $kategori,
                    'semester' => $semester,
                    'perihal' => $perihal,
                    'sasaran' => $sasaran,
                    'admin' => $admin,
                    'timestamps' => $timestamp,
                ];
                $this->SkModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Mengubah Data SK');
                return redirect()->to(base_url('/sk'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,50480],'
                ]);
                $input2 = $this->validate([
                    'nomor' => 'required[nomor],',
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format Dokumen tidak sesuai');
                    return redirect()->to(base_url('/sk'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/sk'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->SkModel->where('id', $id)->first();
                    $namafile = $cekfile['file'];
                    $filesource = '../writable/uploads/content/sk/' . $namafile . '';
                    chmod($filesource, 0777);
                    unlink($filesource);
                    $newName = $file->getRandomName();
                    $file->store('content/sk/', $newName);
                    $nama_foto = $newName;
                    $data = [
                        'nomor' => $nomor,
                        'jenis' => $jenis,
                        'tanggal' => $tanggal,
                        'kategori' => $kategori,
                        'semester' => $semester,
                        'perihal' => $perihal,
                        'sasaran' => $sasaran,
                        'file' => $nama_foto,
                        'admin' => $admin,
                        'timestamps' => $timestamp,
                    ];
                    $this->SkModel->update($id, $data);
                    session()->setFlashdata('pesanInput', 'Mengubah Data SK');
                    return redirect()->to(base_url('/sk'));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->SkModel->where('id', $id)->first();
        $nama_file = $cekfile['file'];
        $filepath = '../writable/uploads/content/sk/' . $nama_file . '';
        chmod($filepath, 0777);
        unlink($filepath);
        $this->SkModel->delete($id);

        session()->setFlashdata('pesanHapus', 'SK Berhasil Di Hapus !');
        return redirect()->to(base_url('/sk'));
    }
}
