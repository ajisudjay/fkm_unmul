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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Pejabat',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/pejabat/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $data = [
                    'pejabat' => $this->PejabatModel
                        ->select('pejabat.*, users.nama as nama_admin')
                        ->join('users', 'pejabat.admin = users.username')
                        ->orderBy('id', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/pejabat/view', $data)
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
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $validation = \Config\Services::validation();
            $nama = $request->getVar('nama');
            $urutan = $request->getVar('urutan');
            $jabatan = $request->getVar('jabatan');
            $file = $request->getfile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if ($request->isAJAX()) {
                $valid = $this->validate([
                    'urutan' => [
                        'label' => 'Urutan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                        ]
                    ],
                    'jabatan' => [
                        'label' => 'Jabatan',
                        'rules' => 'required|alpha_numeric_punct',
                        'errors' => [
                            'required' => '* {field} Tidak Boleh Kosong',
                            'alpha_numeric_punct' => '{field} Format Tidak Sesuai',
                        ]
                    ],
                    'file' => [
                        'label' => 'Gambar',
                        'rules' => 'uploaded[file]|max_size[file,512]|mime_in[file,image/png,image/jpeg]|is_image[file]',
                        'errors' => [
                            'uploaded' => '* {field} Tidak Boleh Kosong !',
                            'max_size' => '{field} ukuran lebih dari 512 kb !',
                            'mime_in' => 'Ekstensi tidak sesuai !',
                            'is_image' => 'Ekstensi tidak sesuai !',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'urutan' => $validation->getError('urutan'),
                            'nama' => $validation->getError('nama'),
                            'jabatan' => $validation->getError('jabatan'),
                            'file' => $validation->getError('file'),
                        ],
                    ];
                    return $this->response->setJSON($msg);
                } else {
                    $namagambar = $file->getRandomName();
                    $file->store('content/pejabat/', $namagambar);
                    $data = [
                        'urutan' => $urutan,
                        'nama' => $nama,
                        'jabatan' => $jabatan,
                        'gambar' => $namagambar,
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->PejabatModel->insert($data);

                    $msg = [
                        'title' => 'Berhasil'
                    ];
                    echo json_encode($msg);
                }
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $nama = $request->getVar('nama');
            $jabatan = $request->getVar('jabatan');
            $urutan = $request->getVar('urutan');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $data = [
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'urutan' => $urutan,
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->PejabatModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Data Pejabat');
                return redirect()->to(base_url('/pejabat'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,512]|mime_in[file,image/png,image/jpeg]|is_image[file],'
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
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
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->PejabatModel->update($id, $data);

                    session()->setFlashdata('pesanInput', 'Berhasil diubah');
                    return redirect()->to(base_url('/pejabat'));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $cekfile = $this->PejabatModel->where('id', $id)->first();
            $namafile = $cekfile['gambar'];
            $filesource = '../writable/uploads/content/pejabat/' . $namafile . '';
            chmod($filesource, 0777);
            unlink($filesource);
            $this->PejabatModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/pejabat'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
