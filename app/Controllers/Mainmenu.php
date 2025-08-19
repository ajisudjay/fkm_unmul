<?php

namespace App\Controllers;

use App\Models\MainmenuModel;
use App\Models\ProdiModel;
use App\Controllers\BaseController;

class Mainmenu extends BaseController
{
    protected $MainmenuModel;
    protected $ProdiModel;
    public function __construct()
    {
        $this->MainmenuModel = new MainmenuModel();
        $this->ProdiModel = new ProdiModel();
    }
    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            $prodix = session()->get('prodi');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            if (session()->get('prodi') === 'Fakultas') {
                $data = [
                    'title' => 'Main Menu',
                    'admin' => $admin,
                    'akses' => 'Fakultas',
                    'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                    'lvl' => $lvl,
                    'foto' => $gambar,
                ];
            } else {
                $data = [
                    'title' => 'Main Menu',
                    'admin' => $admin,
                    'akses' => 'Prodi',
                    'prodi' => $this->ProdiModel->where('prodi', $prodix)->get()->getResultArray(),
                    'lvl' => $lvl,
                    'foto' => $gambar,
                ];
            }
            return view('backend/mainmenu/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $username = session()->get('username');
            $halaman = $request->getVar('halaman');
            if ($request->isAJAX()) {
                $data = [
                    'halaman' => $halaman,
                    'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                    'mainmenu' => $this->MainmenuModel
                        ->select('mainmenu.*, users.nama as nama_admin')
                        ->join('users', 'mainmenu.admin = users.username', 'left')
                        ->orderBy('urutan', 'ASC')->where('halaman', $halaman)->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/mainmenu/view', $data)
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
            if ($request->isAJAX()) {
                $urutan = $request->getVar('urutan');
                $mainmenu = $request->getVar('mainmenu');
                $halaman = $request->getVar('halaman');
                $username = session()->get('username');
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $timestamp = date("Y-m-d h:i:sa");
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'urutan' => [
                        'label' => 'Urutan',
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'numeric' => '* {field} Tidak Boleh Selain Angka',
                        ]
                    ],
                    'mainmenu' => [
                        'label' => 'Main Menu',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '* {field} Format Tidak Sesuai',
                        ]
                    ],
                    'halaman' => [
                        'label' => 'Halaman',
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
                            'halaman' => $validation->getError('halaman'),
                        ],
                    ];
                    echo json_encode($msg);
                } else {
                    $data = [
                        'urutan' => $urutan,
                        'mainmenu' => $mainmenu,
                        'halaman' => $halaman,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->MainmenuModel->insert($data);

                    $data2 = [
                        'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                        'halaman' => $halaman,
                        'mainmenu' => $this->MainmenuModel
                            ->select('mainmenu.*, users.nama as nama_admin')
                            ->join('users', 'mainmenu.admin = users.username', 'left')
                            ->orderBy('urutan', 'ASC')->where('halaman', $halaman)->get()->getResultArray(),
                    ];

                    $msg = [
                        'status' => 'berhasil',
                        'data' => view('backend/mainmenu/view', $data2)
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
            if ($request->isAJAX()) {
                $id = $request->getVar('id');
                $urutan = $request->getVar('urutan');
                $mainmenu = $request->getVar('mainmenu');
                $halaman = $request->getVar('halaman');
                $username = session()->get('username');
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $timestamp = date("Y-m-d h:i:sa");
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'urutan' => [
                        'label' => 'Urutan',
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'numeric' => '* {field} Tidak Boleh Selain Angka',
                        ]
                    ],
                    'mainmenu' => [
                        'label' => 'Main Menu',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '* {field} Format Tidak Sesuai',
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
                        'halaman' => $halaman,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];

                    $this->MainmenuModel->update($id, $data);

                    $data2 = [
                        'mainmenu' => $this->MainmenuModel
                            ->select('mainmenu.*, users.nama as nama_admin')
                            ->join('users', 'mainmenu.admin = users.username', 'left')
                            ->orderBy('urutan', 'ASC')->where('halaman', $halaman)->get()->getResultArray(),
                        'halaman' => $halaman,
                        'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                    ];
                    $msg = [
                        'status' => 'Berhasil',
                        'data' => view('backend/mainmenu/view', $data2)
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

            $this->MainmenuModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/mainmenu'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
