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
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
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
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function view()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
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
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function tambahform()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file <  1) {
                $gambar = '/app-assets/images/profile/user-profile.png';
            } else {
                $gambar = 'content/user/' . $file;
            }
            $data = [
                'title' => 'Berita',
                'title_pages' => '',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
                'validation' => \Config\Services::validation(),
            ];
            return view('backend/berita/tambahform', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function tambah()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
            $username = session()->get('username');
            $request = \Config\Services::request();
            $judul = $request->getVar('judul');
            $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
            $kategori = $request->getVar('kategori');
            $tanggal = $request->getVar('tanggal');
            $isi = $request->getVar('isi');
            $tag = $request->getVar('tag');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $penulis = $username;
            $file = $request->getFile('file');
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpeg]|is_image[file],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
                return redirect()->to(base_url('/berita'));
            } else {
                $newName = $file->getRandomName();
                $file->store('content/berita/', $newName);
                $nama_foto = $newName;
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'kategori' => $kategori,
                    'tanggal' => $tanggal,
                    'tag' => $tag,
                    'isi' => $isi,
                    'banner' => $nama_foto,
                    'dilihat' => 1,
                    'timestamp' => $timestamp,
                    'penulis' => $penulis,
                ];
                $this->BeritaModel->insert($data);

                return redirect()->to(base_url("/berita/thumb/$nama_foto"));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function thumb($namafoto)
    {
        $cekfile = $this->BeritaModel->where('banner', $namafoto)->first();
        $namafile = $cekfile['banner'];
        $filesource = '../writable/uploads/content/berita/' . $namafile;
        list($width, $heigth) = getimagesize($filesource);
        $ratio = $width / $heigth;
        $max = 500;
        if ($width > $max || $heigth > $max) {
            if ($width > $heigth) {
                $newwidht = round($max);
                $newheigth = round($max / $ratio);
            } else {
                $newheigth = round($max);
                $newwidht = round($max * $ratio);
            }
        } else {
            $newwidht = round($width);
            $newheigth = round($heigth);
        }
        $thumb = imagecreatetruecolor($newwidht, $newheigth);
        $exp = explode(".", $namafile);
        $extension = end($exp);
        if ($extension == 'png' | $extension == 'PNG') {
            $source = imagecreatefrompng($filesource);
        } else {
            $source = imagecreatefromjpeg($filesource);
        }

        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidht, $newheigth, $width, $heigth);
        $target = "../writable/uploads/content/berita/thumb/$namafoto";
        imagewebp($thumb, $target, 80);
        session()->setFlashdata('pesanHapus', 'Berhasil !');
        return redirect()->to(base_url('/berita'));
    }

    public function editform($slug)
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
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
                'berita' => $this->BeritaModel->where('slug', $slug)->first(),
                'validation' => \Config\Services::validation(),
            ];
            return view('backend/berita/editform', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
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

                session()->setFlashdata('pesanInput', 'Berhasil diubah!');
                return redirect()->to(base_url('/berita'));
            } else {
                $input = $this->validate([
                    'file' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpeg]|is_image[file],'
                ]);
                if (!$input) { // Not valid
                    session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
                    return redirect()->to(base_url('/berita'));
                } else {
                    $file = $request->getFile('file');
                    $cekfile = $this->BeritaModel->where('id', $id)->first();
                    $namafile = $cekfile['banner'];
                    $filesource = '../writable/uploads/content/berita/' . $namafile . '';
                    $filesourcethumb = '../writable/uploads/content/berita/thumb/' . $namafile . '';
                    chmod($filesource, 0777);
                    chmod($filesourcethumb, 0777);
                    unlink($filesource);
                    unlink($filesourcethumb);
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
                    return redirect()->to(base_url("/berita/thumb/$nama_foto"));
                }
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') !== NULL && session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Fakultas' || session()->get('level') === 'Admin Prodi') {
            $cekfile = $this->BeritaModel->where('id', $id)->first();
            $namafile = $cekfile['banner'];
            $filesource = '../writable/uploads/content/berita/' . $namafile . '';
            $filesourcethumb = '../writable/uploads/content/berita/thumb/' . $namafile . '';
            chmod($filesource, 0777);
            chmod($filesourcethumb, 0777);
            unlink($filesource);
            unlink($filesourcethumb);
            $this->BeritaModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/berita'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
