<?php

namespace App\Controllers;

use App\Models\MainmenuModel;
use App\Models\SubmenuModel;
use App\Controllers\BaseController;
use PhpParser\Node\Expr\Empty_;

class Submenu extends BaseController
{
    protected $MainmenuModel;
    protected $SubmenuModel;
    public function __construct()
    {
        $this->MainmenuModel = new MainmenuModel();
        $this->SubmenuModel = new SubmenuModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Submenu',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/submenu/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $data = [
                    'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
                    'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/submenu/view', $data)
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
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $username = session()->get('username');
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $urutan = $request->getVar('urutan');
                $mainmenu = $request->getVar('mainmenu');
                $submenu = $request->getVar('submenu');
                $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
                $isi = $request->getVar('isi');
                $timestamp = date("Y-m-d");
                $penulis = $username;
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
                    'submenu' => [
                        'label' => 'Sub Menu',
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
                            'submenu' => $validation->getError('submenu'),
                        ],
                    ];
                    echo json_encode($msg);
                } else {
                    $data = [
                        'urutan' => $urutan,
                        'submenu' => $submenu,
                        'slug' => $slug,
                        'id_mainmenu' => $mainmenu,
                        'content' => $isi,
                        'timestamp' => $timestamp,
                        'penulis' => $penulis,
                    ];
                    $this->SubmenuModel->insert($data);
                    $data2 = [
                        'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
                        'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    ];
                    $msg = [
                        'status' => 'berhasil',
                        'data' => view('backend/submenu/view', $data2)
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

    public function editform()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $request = \Config\Services::request();
            $slug = $request->getVar('slug');
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Sub Menu',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
                'slug' => $slug,
                'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->where('submenu.slug', $slug)->first(),
                'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            return view('backend/submenu/edit', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $username = session()->get('username');
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $urutan = $request->getVar('urutan');
            $mainmenu = $request->getVar('mainmenu');
            $submenu = $request->getVar('submenu');
            $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
            $isi = $request->getVar('isi');
            $timestamp = date("Y-m-d");
            $penulis = $username;
            $data = [
                'urutan' => $urutan,
                'submenu' => $submenu,
                'slug' => $slug,
                'id_mainmenu' => $mainmenu,
                'content' => $isi,
                'timestamp' => $timestamp,
                'penulis' => $penulis,
            ];
            $this->SubmenuModel->update($id, $data);
            session()->setFlashdata('pesanHapus', 'Berhasil diubah !');
            return redirect()->to(base_url('/submenu'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin' || session()->get('level') !== 'Admin Prodi') {
            $this->SubmenuModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/submenu'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
