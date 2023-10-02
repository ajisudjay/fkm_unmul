<?php

namespace App\Controllers;

use App\Models\LaboratoriumModel;
use App\Controllers\BaseController;
use PhpParser\Node\Expr\Empty_;

class Laboratorium extends BaseController
{
    protected $LaboratoriumModel;
    public function __construct()
    {
        $this->LaboratoriumModel = new LaboratoriumModel();
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
            'title' => 'Laboratorium',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/laboratorium/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'laboratorium' => $this->LaboratoriumModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/laboratorium/view', $data)
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
        $isi = $request->getVar('isi');
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        if (!$input) { // Not valid
            session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
            return redirect()->to(base_url('/laboratorium'));
        } else {
            $newName = $file->getRandomName();
            $file->store('content/laboratorium/', $newName);
            $nama_foto = $newName;
            $data = [
                'nama' => $nama,
                'content' => $isi,
                'gambar' => $nama_foto,
            ];
            $this->LaboratoriumModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Gambar');
            return redirect()->to(base_url('/laboratorium'));
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
        $isi = $request->getVar('isi');
        $file = $request->getFile('file');
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nama' => $nama,
                'content' => $isi,
            ];
            $this->LaboratoriumModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Laboratorium');
            return redirect()->to(base_url('/laboratorium'));
        } else {
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/laboratorium'));
            } else {
                $file = $request->getFile('file');
                $cekfile = $this->LaboratoriumModel->where('id', $id)->first();
                $namafile = $cekfile['gambar'];
                $filesource = '../writable/uploads/content/laboratorium/' . $namafile . '';
                chmod($filesource, 0777);
                unlink($filesource);
                $newName = $file->getRandomName();
                $file->store('content/laboratorium/', $newName);
                $nama_foto = $newName;
                $data = [
                    'nama' => $nama,
                    'content' => $isi,
                    'gambar' => $nama_foto,
                ];
                $this->LaboratoriumModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Laboratorium');
                return redirect()->to(base_url('/laboratorium'));
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->LaboratoriumModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/laboratorium/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->LaboratoriumModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Laboratorium Berhasil Di Hapus !');
        return redirect()->to(base_url('/laboratorium'));
    }
}
