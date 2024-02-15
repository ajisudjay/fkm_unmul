<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $UsersModel;
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }
    public function index()
    {

        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $admin = session()->get('nama');
        $lvl = session()->get('level');
        $file = session()->get('file');
        if ($file === NULL) {
            $gambar = 'user-profile.png';
        } else {
            $gambar = $file;
        }
        $data = [
            'title' => 'Akun',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/user/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UsersModel->orderBy('nama', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/user/view', $data)
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

        $username = $request->getVar('username');
        $nama = $request->getVar('nama');
        $password = $request->getVar('password');
        $repassword = $request->getVar('repassword');
        $level = $request->getVar('level');
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        $input2 = $this->validate([
            'repassword' => 'matches[password],'
        ]);
        if ($input2) { // Not valid
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/user'));
            } else {
                $newName = $file->getRandomName();
                $file->store('content/user/', $newName);
                $nama_foto = $newName;
                $data = [
                    'username' => $username,
                    'nama' => $nama,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'level' => $level,
                    'file' => $nama_foto,
                ];
                $this->UsersModel->insert($data);

                session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Akun');
                return redirect()->to(base_url('/user'));
            }
        } else {
            session()->setFlashdata('pesanGagal2', 'Konfirmasi password tidak sesuai');
            return redirect()->to(base_url('/user'));
        }
    }


    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $username = $request->getVar('username');
        $nama = $request->getVar('nama');
        $password = $request->getVar('password');
        $repassword = $request->getVar('repassword');
        $level = $request->getVar('level');
        $file = $request->getFile('file');
        $input2 = $this->validate([
            'repassword' => 'matches[password],'
        ]);
        if ($input2) { // Not valid
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $data = [
                    'username' => $username,
                    'nama' => $nama,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'level' => $level,
                ];
                $this->UsersModel->update($username, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data User');
                return redirect()->to(base_url('/user'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,2048],'
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                    return redirect()->to(base_url('/user'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->UsersModel->where('username', $username)->first();
                    $namafile = $cekfile['file'];
                    $filesource = '../writable/uploads/content/user/' . $namafile . '';
                    chmod($filesource, 0777);
                    unlink($filesource);
                    $newName = $file->getRandomName();
                    $file->store('content/user/', $newName);
                    $nama_foto = $newName;
                    $data = [
                        'username' => $username,
                        'nama' => $nama,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'level' => $level,
                        'file' => $nama_foto,
                    ];
                    $this->UsersModel->update($username, $data);

                    session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Akun');
                    return redirect()->to(base_url('/user'));
                }
            }
        } else {
            session()->setFlashdata('pesanGagal2', 'Konfirmasi password tidak sesuai');
            return redirect()->to(base_url('/user'));
        }
    }

    public function hapus($username)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->UsersModel->where('username', $username)->first();
        $namafile = $cekfile['file'];
        $filesource = '../writable/uploads/content/user/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->UsersModel->delete($username);

        session()->setFlashdata('pesanHapus', 'Akun Berhasil Di Hapus !');
        return redirect()->to(base_url('/user'));
    }
}
