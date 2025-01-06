<?php

namespace App\Controllers;

use App\Models\S_masukModel;
use App\Models\DisposisiModel;
use App\Controllers\BaseController;


class S_masuk extends BaseController
{
    protected $S_masukModel;
    protected $DisposisiModel;
    public function __construct()
    {
        $this->S_masukModel = new S_masukModel();
        $this->DisposisiModel = new DisposisiModel();
    }
    public function index()
    {

        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file === NULL) {
                $gambar = 'user-profile.png';
            } else {
                $gambar = $file;
            }
            $data = [
                'title' => 'Surat Masuk',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/s_masuk/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function view()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $data = [
                    's_masuk' => $this->S_masukModel->orderBy('tgl_sm', 'DESC')->get()->getResultArray(),
                    'disposisi' => $this->DisposisiModel->orderBy('timestamp', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/s_masuk/view', $data)
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
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $no_disposisi = $request->getVar('no_disposisi');
            $tgl_sm = $request->getVar('tgl_sm');
            $no_surat = $request->getVar('no_surat');
            $tgl_surat = $request->getVar('tgl_surat');
            $asal_surat = $request->getVar('asal_surat');
            $keterangan = $request->getVar('keterangan');
            $perihal = $request->getVar('perihal');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            $date = new \DateTime($tgl_sm);
            $tahun_surat = $date->format('Y');
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,5048]'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format file tidak sesuai');
                return redirect()->to(base_url('/s_masuk'));
            } else {
                $newName = $file->getRandomName();
                $file->store('content/s_masuk/', $newName);
                $nama_file = $newName;
                $data = [
                    'no_disposisi' => $no_disposisi,
                    'tgl_sm' => $tgl_sm,
                    'no_surat' => $no_surat,
                    'tgl_surat' => $tgl_surat,
                    'asal_surat' => $asal_surat,
                    'perihal' => $perihal,
                    'keterangan' => $keterangan,
                    'file' => $nama_file,
                    'tahun' => $tahun_surat,
                    'status' => 'Belum Disposisi',
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->S_masukModel->insert($data);
                session()->setFlashdata('pesanHapus', 'Berhasil ditambah !');
                return redirect()->to(base_url('/s_masuk'));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function tambahdisposisi()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $kepada = $request->getVar('kepada');
            $tindak_lanjut = $request->getVar('tindak_lanjut');
            $status = $request->getVar('status');
            $id_sm = $request->getVar('id_sm');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            $cek_id = $this->S_masukModel->where('no_disposisi', $id_sm)->first();
            $id_surat = $cek_id['id'];
            $data = [
                'kepada' => $kepada,
                'tindak_lanjut' => $tindak_lanjut,
                'id_sm' => $id_sm,
                'timestamp' => $timestamp,
                'admin' => $username,
            ];
            $data2 = [
                'status' => $status,
            ];
            $this->DisposisiModel->insert($data);
            $this->S_masukModel->update($id_surat, $data2);
            session()->setFlashdata('pesanHapus', 'Berhasil ditambah !');
            return redirect()->to(base_url('/s_masuk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $no_disposisi = $request->getVar('no_disposisi');
            $tgl_sm = $request->getVar('tgl_sm');
            $no_surat = $request->getVar('no_surat');
            $tgl_surat = $request->getVar('tgl_surat');
            $asal_surat = $request->getVar('asal_surat');
            $keterangan = $request->getVar('keterangan');
            $perihal = $request->getVar('perihal');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            $date = new \DateTime($tgl_sm);
            $tahun_surat = $date->format('Y');
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $input2 = $this->validate([
                    'no_surat' => 'required[no_surat],',
                    'tgl_surat' => 'required[tgl_surat],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_masuk'));
                }
                $data = [
                    'no_disposisi' => $no_disposisi,
                    'tgl_sm' => $tgl_sm,
                    'no_surat' => $no_surat,
                    'tgl_surat' => $tgl_surat,
                    'asal_surat' => $asal_surat,
                    'perihal' => $perihal,
                    'keterangan' => $keterangan,
                    'tahun' => $tahun_surat,
                    'status' => 'Belum Disposisi',
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->S_masukModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Mengubah Data Surat Masuk');
                return redirect()->to(base_url('/s_masuk'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,5048],'
                ]);
                $input2 = $this->validate([
                    'no_surat' => 'required[no_surat],',
                    'tgl_surat' => 'required[tgl_surat],',
                    'perihal' => 'required[perihal],',
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format Dokumen tidak sesuai');
                    return redirect()->to(base_url('/s_masuk'));
                } elseif (!$input2) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format tidak sesuai');
                    return redirect()->to(base_url('/s_masuk'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->S_masukModel->where('id', $id)->first();
                    $namafile = $cekfile['file'];
                    $filesource = '../writable/uploads/content/s_masuk/' . $namafile . '';
                    chmod($filesource, 0777);
                    unlink($filesource);
                    $newName = $file->getRandomName();
                    $file->store('content/s_masuk/', $newName);
                    $nama_file = $newName;
                    $data = [
                        'no_disposisi' => $no_disposisi,
                        'tgl_sm' => $tgl_sm,
                        'no_surat' => $no_surat,
                        'tgl_surat' => $tgl_surat,
                        'asal_surat' => $asal_surat,
                        'perihal' => $perihal,
                        'keterangan' => $keterangan,
                        'file' => $nama_file,
                        'tahun' => $tahun_surat,
                        'status' => 'Belum Disposisi',
                        'timestamp' => $timestamp,
                        'admin' => $username,
                    ];
                    $this->S_masukModel->update($id, $data);
                    session()->setFlashdata('pesanInput', 'Berhasil Diubah');
                    return redirect()->to(base_url('/s_masuk'));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function editdisposisi()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $kepada = $request->getVar('kepada');
            $tindak_lanjut = $request->getVar('tindak_lanjut');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d H:i:sa");
            $input2 = $this->validate([
                'tindak_lanjut' => 'required[tindak_lanjut],',
            ]);
            if (!$input2) { // Not valid
                session()->setFlashdata('pesanGagal', 'Tidak Boleh Kosong');
                return redirect()->to(base_url('/s_masuk'));
            }
            $data = [
                'kepada' => $kepada,
                'tindak_lanjut' => $tindak_lanjut,
                'timestamp' => $timestamp,
                'admin' => $username,
            ];
            $this->DisposisiModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Sudah Diubah');
            return redirect()->to(base_url('/s_masuk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $cekfile = $this->S_masukModel->where('id', $id)->first();
            $namafile = $cekfile['file'];
            $filesource = '../writable/uploads/content/s_masuk/' . $namafile . '';
            chmod($filesource, 0777);
            unlink($filesource);
            $this->S_masukModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/s_masuk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapusdisposisi($id)
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin') {
            $this->DisposisiModel->delete($id);
            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/s_masuk'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
