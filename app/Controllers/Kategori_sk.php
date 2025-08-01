<?php

namespace App\Controllers;

use App\Models\Kategori_skModel;
use App\Controllers\BaseController;

class Kategori_sk extends BaseController
{
    protected $Kategori_skModel;
    public function __construct()
    {
        $this->Kategori_skModel = new Kategori_skModel();
    }

    public function index()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Kategori SK',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/kategori_sk/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $data = [
                    'kategori_sk' => $this->Kategori_skModel->orderBy('id', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/kategori_sk/view', $data)
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $request = \Config\Services::request();
            $kategori_sk = $request->getVar('kategori_sk');
            $data = [
                'kategori' => $kategori_sk,
            ];
            $this->Kategori_skModel->insert($data);
            session()->setFlashdata('pesanHapus', 'Berhasil !');
            return redirect()->to(base_url('/kategori_sk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $kategori_sk = $request->getVar('kategori_sk');
            $data = [
                'kategori' => $kategori_sk,
            ];
            $this->Kategori_skModel->update($id, $data);
            session()->setFlashdata('pesanHapus', 'Berhasil !');
            return redirect()->to(base_url('/kategori_sk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $this->Kategori_skModel->delete($id);
            session()->setFlashdata('pesanHapus', 'Kategori_sk Berhasil Di Hapus !');
            return redirect()->to(base_url('/kategori_sk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
