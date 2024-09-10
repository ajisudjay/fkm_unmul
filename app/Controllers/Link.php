<?php

namespace App\Controllers;

use App\Models\LinkModel;
use App\Controllers\BaseController;

class Link extends BaseController
{
    protected $LinkModel;
    public function __construct()
    {
        $this->LinkModel = new LinkModel();
    }
    public function index()
    {
        if (session()->get('username') !== NULL && (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website')) {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Link Partner',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/link/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('username') !== NULL && (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website')) {
            $request = \Config\Services::request();
            $username = session()->get('username');
            if ($request->isAJAX()) {
                $data = [
                    'title' => 'Link Partner',
                    'link' => $this->LinkModel->orderBy('judul', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/link/view', $data)
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
        if (session()->get('username') !== NULL && (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website')) {

            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $kategori = $request->getVar('kategori');
            $judul = $request->getVar('judul');
            $link = $request->getVar('link');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'judul' => [
                        'label' => 'Judul',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'link' => [
                        'label' => 'Link',
                        'rules' => 'required|valid_url_strict',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'valid_url_strict' => '* {field} Format Tidak Sesuai',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'judul' => $validation->getError('judul'),
                            'link' => $validation->getError('link'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $data = [
                        'kategori' => $kategori,
                        'judul' => $judul,
                        'link' => $link,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->LinkModel->insert($data);

                    $msg = [
                        'title' => 'Berhasil'
                    ];

                    session()->setFlashdata('pesanBerhasil', 'Data Berhasil Ditambahkan !');
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
        if (session()->get('username') !== NULL && (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website')) {

            $this->LinkModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Main Menu Berhasil Di Hapus !');
            return redirect()->to(base_url('/link'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
