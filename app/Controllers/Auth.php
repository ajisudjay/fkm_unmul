<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $UsersModel;
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }
    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if ($request->isAJAX()) {
            $username = $request->getPost('username');
            $password = $request->getPost('password');
            $captcha = $request->getPost('captcha');
            $captcha2 = $request->getPost('captcha2');
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $user = $this->UsersModel->where('username', $username)->first();
                if ($user < 1) {
                    $msg = [
                        'title' => 'gagaluser',
                        'pesan' => 'Username Tidak Terdaftar',
                    ];
                    echo json_encode($msg);
                } elseif ($captcha2 != $captcha) {
                    $msg = [
                        'title' => 'gagallogin',
                        'pesan' => 'Kode Keamanan Salah',
                    ];
                    echo json_encode($msg);
                } else {
                    $hash_pass = $user['password'];
                    if ($user['username'] === $username && password_verify($password, $hash_pass)) {
                        session()->set('username', $user['username']);
                        session()->set('password', $user['password']);
                        session()->set('nama', $user['nama']);
                        session()->set('level', $user['level']);
                        $msg = [
                            'title' => 'berhasiloperator',
                            'urloperator' => '/auth/beranda',
                        ];
                        echo json_encode($msg);
                    } else {
                        $msg = [
                            'title' => 'gagaluser2',
                            'pesan' => 'Username dan Password Tidak Sesuai',
                        ];
                        echo json_encode($msg);
                    }
                }
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function beranda()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UsersModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('nama', $cek['nama']);
        session()->set('level', $cek['level']);
        session()->set('file', $cek['file']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        if ($cek['level'] === 'Superadmin') {
            return redirect()->to(base_url('/superadmin'));
        } elseif ($cek['level'] === 'Admin Fakultas') {
            return redirect()->to(base_url('/adminfakultas'));
        }
    }



    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesanLogout', 'Berhasil Keluar !');
        return redirect()->to(base_url('/login'));
    }
}
