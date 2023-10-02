<?php

namespace App\Controllers;

use App\Models\TendikModel;
use App\Controllers\BaseController;

class Tendik extends BaseController
{
    protected $TendikModel;
    public function __construct()
    {
        $this->TendikModel = new TendikModel();
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
            'title' => 'Tendik',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/tendik/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'tendik' => $this->TendikModel->orderBy('nip', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/tendik/view', $data)
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

        $nip = $request->getVar('nip');
        $nama = $request->getVar('nama');
        $jabatan = $request->getVar('jabatan');
        $ruangan = $request->getVar('ruangan');
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        if (!$input) { // Not valid
            session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
            return redirect()->to(base_url('/tendik'));
        } else {
            $newName = $file->getRandomName();
            $file->store('content/tendik/', $newName);
            $nama_foto = $newName;
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'ruangan' => $ruangan,
                'gambar' => $nama_foto,
            ];
            $this->TendikModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Tendik');
            return redirect()->to(base_url('/tendik'));
        }
    }


    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $nip = $request->getVar('nip');
        $nama = $request->getVar('nama');
        $jabatan = $request->getVar('jabatan');
        $ruangan = $request->getVar('ruangan');
        $file = $request->getFile('file');
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'ruangan' => $ruangan,
            ];
            $this->TendikModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Tendik');
            return redirect()->to(base_url('/tendik'));
        } else {
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/tendik'));
            } else {
                $file = $request->getFile('file');
                $cekfile = $this->TendikModel->where('id', $id)->first();
                $namafile = $cekfile['gambar'];
                $filesource = '../writable/uploads/content/tendik/' . $namafile . '';
                chmod($filesource, 0777);
                unlink($filesource);
                $newName = $file->getRandomName();
                $file->store('content/tendik/', $newName);
                $nama_foto = $newName;
                $data = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'ruangan' => $ruangan,
                    'gambar' => $nama_foto,
                ];
                $this->TendikModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Tendik');
                return redirect()->to(base_url('/tendik'));
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->TendikModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/tendik/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->TendikModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Tendik Berhasil Di Hapus !');
        return redirect()->to(base_url('/tendik'));
    }
}
