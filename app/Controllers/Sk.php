<?php

namespace App\Controllers;

use App\Models\SkModel;
use App\Controllers\BaseController;

class Sk extends BaseController
{
    protected $SkModel;
    public function __construct()
    {
        $this->SkModel = new SkModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file <  1) {
                $gambar = 'app-assets/images/profile/user-profile.png';
            } else {
                $gambar = 'content/user/' . $file;
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
                    'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->get()->getResultArray(),
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
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nomor = $request->getVar('nomor');
            $jenis = $request->getVar('jenis');
            $tanggal = $request->getVar('tanggal');
            $perihal = $request->getVar('perihal');
            $kategori = $request->getVar('kategori');
            $sasaran = $request->getVar('sasaran');
            $admin = 'aji';
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nomor' => [
                    'label' => 'Nomor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jenis' => [
                    'label' => 'Jenis',
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
                'perihal' => [
                    'label' => 'Perihal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'kategori' => [
                    'label' => 'Kategori',
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nomor' => $validation->getError('nomor'),
                        'jenis' => $validation->getError('jenis'),
                        'tanggal' => $validation->getError('tanggal'),
                        'perihal' => $validation->getError('perihal'),
                        'kategori' => $validation->getError('kategori'),
                        'sasaran' => $validation->getError('sasaran'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'nomor' => $nomor,
                    'jenis' => $jenis,
                    'tanggal' => $tanggal,
                    'perihal' => $perihal,
                    'kategori' => $kategori,
                    'sasaran' => $sasaran,
                    'admin' => $admin,
                    'timestamps' => $timestamp,
                ];
                $this->SkModel->insert($data);

                $data2 = [
                    'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->get()->getResultArray(),
                ];

                $msg = [
                    'sukses' => 'SK Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('backend/sk/view', $data2)
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
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $urutan = $request->getVar('urutan');
            $mainmenu = $request->getVar('mainmenu');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'urutan' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'mainmenu' => [
                    'label' => 'Main Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'urutan' => $validation->getError('urutan'),
                        'mainmenu' => $validation->getError('mainmenu'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'urutan' => $urutan,
                    'mainmenu' => $mainmenu,
                ];

                $this->SkModel->update($id, $data);

                $data2 = [
                    'sk' => $this->SkModel->orderBy('tanggal', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Main Menu Berhasil Diubah !',
                    'status' => 'Berhasil',
                    'data' => view('backend/sk/view', $data2)
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
        $this->SkModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Main Menu Berhasil Di Hapus !');
        return redirect()->to(base_url('/mainmenu'));
    }
}
