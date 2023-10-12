<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Controllers\BaseController;
use PhpParser\Node\Expr\Empty_;

class Berita extends BaseController
{
    protected $BeritaModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
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
            'title' => 'Berita',
            'title_pages' => '',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/berita/index', $data);
    }
    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'berita' => $this->BeritaModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/berita/view', $data)
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
        $username = session()->get('username');
        $request = \Config\Services::request();
        $judul = $request->getVar('judul');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
        $tanggal = $request->getVar('tanggal');
        $isi = $request->getVar('isi');
        $tag = $request->getVar('tag');
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $timestamp = date("Y-m-d h:i:sa");
        $penulis = $username;
        $file = $request->getFile('file');
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048],'
        ]);
        if (!$input) { // Not valid
            session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
            return redirect()->to(base_url('/berita'));
        } else {
            $newName = $file->getRandomName();
            $file->store('content/berita/', $newName);
            $nama_foto = $newName;
            $data = [
                'judul' => $judul,
                'slug' => $slug,
                'tanggal' => $tanggal,
                'tag' => $tag,
                'isi' => $isi,
                'banner' => $nama_foto,
                'dilihat' => 0,
                'timestamp' => $timestamp,
                'penulis' => $penulis,
            ];
            $this->BeritaModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Berita');
            return redirect()->to(base_url('/berita'));
        }
    }

    public function editform($slug)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $admin = session()->get('nama');
        $lvl = session()->get('level');
        $file = session()->get('file');
        if ($file <  1) {
            $gambar = base_url('app-assets/images/profile/user-profile.png');
        } else {
            $gambar = base_url('content/user/' . $file);
        }
        $data = [
            'title' => 'Berita',
            'title_pages' => '',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
            'berita' => $this->BeritaModel->where('slug', $slug)->first(),
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/berita/editform', $data);
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $username = session()->get('username');
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $judul = $request->getVar('judul');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
        $tanggal = $request->getVar('tanggal');
        $isi = $request->getVar('isi');
        $tag = $request->getVar('tag');
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $timestamp = date("Y-m-d h:i:sa");
        $penulis = $username;
        $file = $request->getFile('file');
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'judul' => $judul,
                'slug' => $slug,
                'tanggal' => $tanggal,
                'tag' => $tag,
                'isi' => $isi,
                'timestamp' => $timestamp,
                'penulis' => $penulis,
            ];
            $this->BeritaModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
            return redirect()->to(base_url('/berita'));
        } else {
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Gagal Ukuran Gambar Maksimal 2MB');
                return redirect()->to(base_url('/berita'));
            } else {
                $file = $request->getFile('file');
                $cekfile = $this->BeritaModel->where('id', $id)->first();
                $namafile = $cekfile['banner'];
                $filesource = '../writable/uploads/content/berita/' . $namafile . '';
                chmod($filesource, 0777);
                unlink($filesource);
                $newName = $file->getRandomName();
                $file->store('content/berita/', $newName);
                $nama_foto = $newName;
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'tanggal' => $tanggal,
                    'tag' => $tag,
                    'isi' => $isi,
                    'banner' => $nama_foto,
                    'timestamp' => $timestamp,
                    'penulis' => $penulis,
                ];
                $this->BeritaModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
                return redirect()->to(base_url('/berita'));
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->BeritaModel->where('id', $id)->first();
        $namafile = $cekfile['banner'];
        $filesource = '../writable/uploads/content/berita/' . $namafile . '';
        chmod($filesource, 0777);
        unlink($filesource);
        $this->BeritaModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Berita Berhasil Di Hapus !');
        return redirect()->to(base_url('/berita'));
    }
}
