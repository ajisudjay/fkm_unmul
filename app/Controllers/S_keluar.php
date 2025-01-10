<?php

namespace App\Controllers;

use App\Models\S_keluarModel;
use App\Controllers\BaseController;

class S_keluar extends BaseController
{
    protected $S_keluarModel;
    public function __construct()
    {
        $this->S_keluarModel = new S_keluarModel();
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
                'title' => 'Surat Keluar',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/s_keluar/index', $data);
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
                    's_keluar' => $this->S_keluarModel->orderBy('no', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/s_keluar/view', $data)
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
            $no = $request->getVar('no');
            $perihal = $request->getVar('perihal');
            $tanggal = $request->getVar('tanggal');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,5048]'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format file tidak sesuai');
                return redirect()->to(base_url('/s_keluar'));
            } else {
                $newName = $file->getRandomName();
                $file->store('content/s_keluar/', $newName);
                $nama_file = $newName;
                $data = [
                    'no' => $no,
                    'perihal' => $perihal,
                    'file' => $nama_file,
                    'tanggal' => $tanggal,
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->S_keluarModel->insert($data);
                session()->setFlashdata('pesanHapus', 'Berhasil ditambah !');
                return redirect()->to(base_url('/s_keluar'));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $no = $request->getVar('no');
            $perihal = $request->getVar('perihal');
            $tanggal = $request->getVar('tanggal');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'no' => 'required[no],',
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                }
                $data = [
                    'no' => $no,
                    'perihal' => $perihal,
                    'tanggal' => $tanggal,
                    'timestamps' => $timestamp,
                ];
                $this->S_keluarModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Mengubah Data Surat Keluar');
                return redirect()->to(base_url('/s_keluar'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,5048],'
                ]);
                $input2 = $this->validate([
                    'no' => 'required[no],',
                    'tanggal' => 'required[tanggal],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format Dokumen tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_keluar'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->S_keluarModel->where('id', $id)->first();
                    $namafile = $cekfile['file'];
                    $filesource = '../writable/uploads/content/s_keluar/' . $namafile . '';
                    chmod($filesource, 0777);
                    unlink($filesource);
                    $newName = $file->getRandomName();
                    $file->store('content/s_keluar/', $newName);
                    $nama_file = $newName;
                    $data = [
                        'no' => $no,
                        'perihal' => $perihal,
                        'tanggal' => $tanggal,
                        'file' => $nama_file,
                        'timestamps' => $timestamp,
                    ];
                    $this->S_keluarModel->update($id, $data);
                    session()->setFlashdata('pesanInput', 'Mengubah Data Surat Keluar');
                    return redirect()->to(base_url('/s_keluar'));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin eOffice') {
            $cekfile = $this->S_keluarModel->where('id', $id)->first();
            $namafile = $cekfile['file'];
            $filesource = '../writable/uploads/content/s_keluar/' . $namafile . '';
            chmod($filesource, 0777);
            unlink($filesource);
            $this->S_keluarModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/s_keluar'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
