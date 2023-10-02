<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\ProdiModel;
use App\Controllers\BaseController;

class Dosen extends BaseController
{
    protected $DosenModel;
    protected $ProdiModel;
    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->ProdiModel = new ProdiModel();
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
            'title' => 'Dosen',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/dosen/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'dosen' => $this->DosenModel->select('*')->select('dosen.id as dosen_id')->select('prodi.id as prodi_id')->join('prodi', 'dosen.id_ps=prodi.id')->orderBy('nip', 'DESC')->get()->getResultArray(),
                'prodi' => $this->ProdiModel->orderBy('id', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/dosen/view', $data)
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
        $bidang = $request->getVar('bidang');
        $prodi = $request->getVar('prodi');
        $pendidikan = $request->getVar('pendidikan');
        $akun = $request->getVar('akun');
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        if (!$input) { // Not valid
            session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
            return redirect()->to(base_url('/dosen'));
        } else {
            $newName = $file->getRandomName();
            $file->store('content/dosen/', $newName);
            $nama_foto = $newName;
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'bidang' => $bidang,
                'id_ps' => $prodi,
                'akun' => $akun,
                'pendidikan' => $pendidikan,
                'gambar' => $nama_foto,
            ];
            $this->DosenModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Dosen');
            return redirect()->to(base_url('/dosen'));
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
        $bidang = $request->getVar('bidang');
        $prodi = $request->getVar('prodi');
        $pendidikan = $request->getVar('pendidikan');
        $akun = $request->getVar('akun');
        $file = $request->getFile('file');
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'bidang' => $bidang,
                'id_ps' => $prodi,
                'akun' => $akun,
                'pendidikan' => $pendidikan,
            ];
            $this->DosenModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Dosen');
            return redirect()->to(base_url('/dosen'));
        } else {
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/dosen'));
            } else {
                $file = $request->getFile('file');
                $cekfile = $this->DosenModel->where('id', $id)->first();
                $namafile = $cekfile['gambar'];
                $filesource = '../writable/uploads/content/dosen/' . $namafile . '';
                chmod($filesource, 0777);
                unlink($filesource);
                $newName = $file->getRandomName();
                $file->store('content/dosen/', $newName);
                $nama_foto = $newName;
                $data = [
                    'nip' => $nip,
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'bidang' => $bidang,
                    'id_ps' => $prodi,
                    'akun' => $akun,
                    'pendidikan' => $pendidikan,
                    'gambar' => $nama_foto,
                ];
                $this->DosenModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Dosen');
                return redirect()->to(base_url('/dosen'));
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->DosenModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/dosen/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->DosenModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Dosen Berhasil Di Hapus !');
        return redirect()->to(base_url('/dosen'));
    }
}
