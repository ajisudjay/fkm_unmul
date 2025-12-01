<?php

namespace App\Controllers;

use App\Models\AplikasiModel;
use App\Models\ProdiModel;
use App\Controllers\BaseController;

class Aplikasi extends BaseController
{
    protected $AplikasiModel;
    protected $ProdiModel;
    public function __construct()
    {
        $this->AplikasiModel = new AplikasiModel();
        $this->ProdiModel = new ProdiModel();
    }
    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Aplikasi',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
                'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
            ];
            return view('backend/aplikasi/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $username = session()->get('username');
            if ($request->isAJAX()) {
                $data = [
                    'aplikasi' => $this->AplikasiModel
                        ->select('aplikasi.*, users.nama as nama_admin')
                        ->join('users', 'aplikasi.admin = users.username')
                        ->get()->getResultArray(),
                    'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/aplikasi/view', $data)
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $halaman = $request->getVar('halaman');
            $nama = $request->getVar('nama');
            $urutan = $request->getVar('urutan');
            $link = $request->getVar('link');
            $gambar = $request->getfile('gambar');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'urutan' => [
                        'label' => 'Urutan',
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
                    'link' => [
                        'label' => 'Link',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'gambar' => [
                        'label' => 'Gambar',
                        'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/png,image/jpeg]|is_image[gambar]',
                        'errors' => [
                            'uploaded' => '* {field} Tidak Boleh Kosong !',
                            'max_size' => '{field} ukuran lebih dari 2 mb !',
                            'mime_in' => 'Ekstensi tidak sesuai !',
                            'is_image' => 'Ekstensi tidak sesuai !',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'urutan' => $validation->getError('urutan'),
                            'nama' => $validation->getError('nama'),
                            'link' => $validation->getError('link'),
                            'gambar' => $validation->getError('gambar'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $namagambar = $gambar->getRandomName();
                    $gambar->store('content/aplikasi/', $namagambar);
                    $data = [
                        'urutan' => $urutan,
                        'halaman' => $halaman,
                        'nama' => $nama,
                        'link' => $link,
                        'gambar' => $namagambar,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->AplikasiModel->insert($data);

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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $id = $request->getVar('id');
            $halaman = $request->getVar('halaman');
            $nama = $request->getVar('nama');
            $link = $request->getVar('link');
            $urutan = $request->getVar('urutan');
            $gambar = $request->getfile('gambar');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'urutan' => [
                        'label' => 'Urutan',
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
                    'link' => [
                        'label' => 'Link',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'urutan' => $validation->getError('urutan'),
                            'nama' => $validation->getError('nama'),
                            'link' => $validation->getError('link'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $data = [
                        'urutan' => $urutan,
                        'halaman' => $halaman,
                        'nama' => $nama,
                        'link' => $link,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->AplikasiModel->update($id, $data);

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

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $cekfile = $this->AplikasiModel->where('id', $id)->first();
            $namafile = $cekfile['gambar'];
            $filesource = '../writable/uploads/content/aplikasi/' . $namafile . '';
            chmod($filesource, 0777);
            unlink($filesource);
            $this->AplikasiModel->delete($id);
            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/aplikasi'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
