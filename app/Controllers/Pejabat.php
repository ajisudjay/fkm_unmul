<?php

namespace App\Controllers;

use App\Models\PejabatModel;
use App\Controllers\BaseController;

class Pejabat extends BaseController
{
    protected $PejabatModel;
    public function __construct()
    {
        $this->PejabatModel = new PejabatModel();
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
            'title' => 'Pejabat',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/pejabat/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/pejabat/view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();

        $nama = $request->getVar('nama');
        $jabatan = $request->getVar('jabatan');
        $urutan = $request->getVar('urutan');
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        if (!$input) { // Not valid
            session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
            return redirect()->to(base_url('/pejabat'));
        } else {
            $newName = $file->getRandomName();
            $file->store('content/pejabat/', $newName);
            $nama_foto = $newName;
            $data = [
                'nama' => $nama,
                'jabatan' => $jabatan,
                'urutan' => $urutan,
                'gambar' => $nama_foto,
            ];
            $this->PejabatModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Pejabat');
            return redirect()->to(base_url('/pejabat'));
        }
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $nama = $request->getVar('nama');
        $jabatan = $request->getVar('jabatan');
        $urutan = $request->getVar('urutan');
        $file = $request->getFile('file');
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nama' => $nama,
                'jabatan' => $jabatan,
                'urutan' => $urutan,
            ];
            $this->PejabatModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Pejabat');
            return redirect()->to(base_url('/pejabat'));
        } else {
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/pejabat'));
            } else {
                $file = $request->getFile('file');
                $cekfile = $this->PejabatModel->where('id', $id)->first();
                $namafile = $cekfile['gambar'];
                $filesource = '../writable/uploads/content/pejabat/' . $namafile . '';
                chmod($filesource, 0777);
                unlink($filesource);
                $newName = $file->getRandomName();
                $file->store('content/pejabat/', $newName);
                $nama_foto = $newName;
                $data = [
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'urutan' => $urutan,
                    'gambar' => $nama_foto,
                ];
                $this->PejabatModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Pejabat');
                return redirect()->to(base_url('/pejabat'));
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->PejabatModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/pejabat/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->PejabatModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Pejabat Berhasil Di Hapus !');
        return redirect()->to(base_url('/pejabat'));
    }
}
