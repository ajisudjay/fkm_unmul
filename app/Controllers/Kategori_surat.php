<?php

namespace App\Controllers;

use App\Models\Kode_suratModel;
use App\Controllers\BaseController;

class Kategori_surat extends BaseController
{
    protected $Kode_suratModel;
    public function __construct()
    {
        $this->Kode_suratModel = new Kode_suratModel();
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
                'title' => 'Kategori Surat',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/kategori_surat/index', $data);
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
                    'kategori_surat' => $this->Kode_suratModel->orderBy('kode_surat', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/kategori_surat/view', $data)
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
            $kategori_surat = $request->getVar('kategori_surat');
            $nama = $request->getVar('nama');
            $data = [
                'kode_surat' => $kategori_surat,
                'nama' => $nama,
            ];
            $this->Kode_suratModel->insert($data);
            session()->setFlashdata('pesanHapus', 'Berhasil !');
            return redirect()->to(base_url('/kategori_surat'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $kategori_surat = $request->getVar('kategori_surat');
            $nama = $request->getVar('nama');
            $data = [
                'kode_surat' => $kategori_surat,
                'nama' => $nama,
            ];
            $this->Kode_suratModel->update($id, $data);
            session()->setFlashdata('pesanHapus', 'Berhasil !');
            return redirect()->to(base_url('/kategori_surat'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }


    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $this->Kode_suratModel->delete($id);
            session()->setFlashdata('pesanHapus', 'Kategori_sk Berhasil Di Hapus !');
            return redirect()->to(base_url('/kategori_surat'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
