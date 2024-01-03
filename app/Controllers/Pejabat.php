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
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'pejabat' => $this->PejabatModel->orderBy('id', 'DESC')->get()->getResultArray(),
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
        $validation = \Config\Services::validation();
        $nama = $request->getVar('nama');
        $urutan = $request->getVar('urutan');
        $jabatan = $request->getVar('jabatan');
        $file = $request->getfile('file');
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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                    ]
                ],
                'file' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpeg]|is_image[file]',
                    'errors' => [
                        'uploaded' => '* {field} Tidak Boleh Kosong !',
                        'max_size' => '{field} ukuran lebih dari 2 mb !',
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
                'file' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpeg]|is_image[file],'
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
                ];
                $this->PejabatModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil diubah');
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

        session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
        return redirect()->to(base_url('/pejabat'));
    }
}
