<?php

namespace App\Controllers;

use App\Models\MitraModel;
use App\Controllers\BaseController;

class Mitra extends BaseController
{
    protected $MitraModel;
    public function __construct()
    {
        $this->MitraModel = new MitraModel();
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
                'title' => 'Mitra',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/mitra/index', $data);
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
                    'mitra' => $this->MitraModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/mitra/view', $data)
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
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $nama = $request->getVar('nama');
        $urutan = $request->getVar('urutan');
        $gambar = $request->getfile('gambar');
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
                        'gambar' => $validation->getError('gambar'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $namagambar = $gambar->getRandomName();
                $gambar->store('content/mitra/', $namagambar);
                $data = [
                    'urutan' => $urutan,
                    'nama' => $nama,
                    'gambar' => $namagambar,
                ];
                $this->MitraModel->insert($data);

                $msg = [
                    'title' => 'Berhasil'
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $id = $request->getVar('id');
        $nama = $request->getVar('nama');
        $urutan = $request->getVar('urutan');
        $gambar = $request->getfile('gambar');
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'urutan' => $validation->getError('urutan'),
                        'nama' => $validation->getError('nama'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $data = [
                    'urutan' => $urutan,
                    'nama' => $nama,
                ];
                $this->MitraModel->update($id, $data);

                $msg = [
                    'title' => 'Berhasil'
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->MitraModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/mitra/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->MitraModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
        return redirect()->to(base_url('/mitra'));
    }
}
