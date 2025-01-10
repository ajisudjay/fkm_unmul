<?php

namespace App\Controllers;

use App\Models\SemesterModel;
use App\Controllers\BaseController;

class Semester extends BaseController
{
    protected $SemesterModel;
    public function __construct()
    {
        $this->SemesterModel = new SemesterModel();
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
                'title' => 'Semester',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/semester/index', $data);
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
                    'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/semester/view', $data)
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
            $semester = $request->getVar('semester');
            $data = [
                'semester' => $semester,
            ];
            $this->SemesterModel->insert($data);
            session()->setFlashdata('pesanHapus', 'Berhasil !');
            return redirect()->to(base_url('/semester'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $this->SemesterModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Semester Berhasil Di Hapus !');
            return redirect()->to(base_url('/semester'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
