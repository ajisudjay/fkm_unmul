<?php

namespace App\Controllers;

use App\Models\KonfigurasiModel;
use App\Controllers\BaseController;

class Konfigurasi extends BaseController
{
    protected $KonfigurasiModel;
    public function __construct()
    {
        $this->KonfigurasiModel = new KonfigurasiModel();
    }
    public function index()
    {

        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $admin = session()->get('nama');
        $lvl = session()->get('level');
        $file = session()->get('file');
        if ($file <  1) {
            $gambar = 'app-assets/images/profile/user-profile.png';
        } else {
            $gambar = 'content/user/' . $file;
        }
        $data = [
            'title' => 'Konfigurasi',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/konfigurasi/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'konfigurasi' => $this->KonfigurasiModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/konfigurasi/view', $data)
            ];
            echo json_encode($msg);
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
            $visi = $request->getVar('visi');
            $misi = $request->getVar('misi');
            $email = $request->getVar('email');
            $telepon = $request->getVar('telepon');
            $alamat = $request->getVar('alamat');
            $ig = $request->getVar('ig');
            $yt = $request->getVar('yt');
            $fb = $request->getVar('fb');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'visi' => [
                    'label' => 'Visi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'misi' => [
                    'label' => 'Misi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'telepon' => [
                    'label' => 'Telepon',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'ig' => [
                    'label' => 'Ig',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'fb' => [
                    'label' => 'Fb',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'yt' => [
                    'label' => 'Yt',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'visi' => $validation->getError('visi'),
                        'misi' => $validation->getError('misi'),
                        'email' => $validation->getError('email'),
                        'telepon' => $validation->getError('telepon'),
                        'alamat' => $validation->getError('alamat'),
                        'ig' => $validation->getError('ig'),
                        'fb' => $validation->getError('fb'),
                        'yt' => $validation->getError('yt'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'visi' => $visi,
                    'misi' => $misi,
                    'email' => $email,
                    'telepon' => $telepon,
                    'alamat' => $alamat,
                    'ig' => $ig,
                    'fb' => $fb,
                    'yt' => $yt,
                ];

                $this->KonfigurasiModel->update($id, $data);

                $data2 = [
                    'konfigurasi' => $this->KonfigurasiModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Konfigurasi Berhasil Diperbarui !',
                    'status' => 'Berhasil',
                    'data' => view('backend/konfigurasi/view', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
