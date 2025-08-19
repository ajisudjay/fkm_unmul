<?php

namespace App\Controllers;

use App\Models\GaleriModel;
use App\Controllers\BaseController;

class Galeri extends BaseController
{
    protected $GaleriModel;
    public function __construct()
    {
        $this->GaleriModel = new GaleriModel();
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
                'title' => 'Galeri',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/galeri/index', $data);
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
                    'galeri' => $this->GaleriModel
                        ->select('galeri.*, users.nama as nama_admin')
                        ->join('users', 'galeri.admin = users.username')->orderBy('id', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/galeri/view', $data)
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
            $nama = $request->getVar('nama');
            $file = $request->getFile('file');
            $username = session()->get('username');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $input = $this->validate([
                'file' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/png,image/jpeg]|is_image[file],'
            ]);
            if (!$input) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format gambar tidak sesuai');
                return redirect()->to(base_url('/galeri'));
            } else {
                $newName = $file->getRandomName();
                $file->store('content/galeri/', $newName);
                $nama_foto = $newName;
                $data = [
                    'nama' => $nama,
                    'gambar' => $nama_foto,
                    'timestamp' => $timestamp,
                    'admin' => $username,
                ];
                $this->GaleriModel->insert($data);

                return redirect()->to(base_url("/galeri/thumb/$nama_foto"));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function thumb($namafoto)
    {
        $cekfile = $this->GaleriModel->where('gambar', $namafoto)->first();
        $namafile = $cekfile['gambar'];
        $filesource = '../writable/uploads/content/galeri/' . $namafile;
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
        $target = "../writable/uploads/content/galeri/thumb/$namafoto";
        imagewebp($thumb, $target, 80);
        session()->setFlashdata('pesanHapus', 'Berhasil !');
        return redirect()->to(base_url('/galeri'));
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $cekfile = $this->GaleriModel->where('id', $id)->first();
            $namafile = $cekfile['gambar'];
            $filesource = '../writable/uploads/content/galeri/' . $namafile . '';
            $filesourcethumb = '../writable/uploads/content/galeri/thumb/' . $namafile . '';
            chmod($filesource, 0777);
            chmod($filesourcethumb, 0777);
            unlink($filesource);
            unlink($filesourcethumb);
            $this->GaleriModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Galeri Berhasil Di Hapus !');
            return redirect()->to(base_url('/galeri'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
