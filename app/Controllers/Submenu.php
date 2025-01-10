<?php

namespace App\Controllers;

use App\Models\MainmenuModel;
use App\Models\SubmenuModel;
use App\Controllers\BaseController;
use PhpParser\Node\Expr\Empty_;

class Submenu extends BaseController
{
    protected $MainmenuModel;
    protected $SubmenuModel;
    public function __construct()
    {
        $this->MainmenuModel = new MainmenuModel();
        $this->SubmenuModel = new SubmenuModel();
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
                'title' => 'Sub Menu',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
            ];
            return view('backend/submenu/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function view()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $level = session()->get('level');
                if ($level === 'Admin Prodi') {
                    $aksesbutton = 'hidden';
                } else {
                    $aksesbutton = '';
                }
                $data = [
                    'aksesbutton' => $aksesbutton,
                    'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->select('submenu.timestamp as timestamp_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
                    'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/submenu/view', $data)
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
            $username = session()->get('username');
            $request = \Config\Services::request();
            $urutan = $request->getVar('urutan');
            $mainmenu = $request->getVar('mainmenu');
            $namamain =   $this->MainmenuModel->select('*')->select('mainmenu.mainmenu as namamain')->where('mainmenu.id', $mainmenu)->first();
            $submenu = $request->getVar('submenu');
            $akses = $request->getVar('akses');
            $slugmain = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($namamain['namamain'])));
            $slugsub = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
            $slug = $slugmain . 'X' . $slugsub;
            $isi = $request->getVar('isi');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $penulis = $username;
            $validasi = $this->validate([
                'submenu' => 'required[submenu]|alpha_numeric_punct[submenu],'
            ]);
            if (!$validasi) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format isian tidak sesuai');
                return redirect()->to(base_url('/submenu'));
            } else {
                $data = [
                    'urutan' => $urutan,
                    'submenu' => $submenu,
                    'slug' => $slug,
                    'id_mainmenu' => $mainmenu,
                    'content' => $isi,
                    'timestamp' => $timestamp,
                    'penulis' => $penulis,
                    'akses' => $akses,
                ];
                $this->SubmenuModel->insert($data);
                session()->setFlashdata('pesanHapus', 'Berhasil ditambah !');
                return redirect()->to(base_url('/submenu'));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }


    public function tambahform()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file <  1) {
                $gambar = base_url('app-assets/images/profile/user-profile.png');
            } else {
                $gambar = base_url('content/user/' . $file);
            }
            $data = [
                'title' => 'Sub Menu',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
                'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            return view('backend/submenu/tambah', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function editform()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $request = \Config\Services::request();
            $slug = $request->getVar('slug');
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $file = session()->get('file');
            if ($file <  1) {
                $gambar = base_url('app-assets/images/profile/user-profile.png');
            } else {
                $gambar = base_url('content/user/' . $file);
            }
            $data = [
                'title' => 'Sub Menu',
                'admin' => $admin,
                'lvl' => $lvl,
                'foto' => $gambar,
                'slug' => $slug,
                'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->where('submenu.slug', $slug)->first(),
                'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            return view('backend/submenu/edit', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $username = session()->get('username');
            $request = \Config\Services::request();
            $id = $request->getVar('id');
            $urutan = $request->getVar('urutan');
            $mainmenu = $request->getVar('mainmenu');
            $namamain =   $this->MainmenuModel->select('*')->select('mainmenu.mainmenu as namamain')->where('mainmenu.id', $mainmenu)->first();
            $submenu = $request->getVar('submenu');
            $akses = $request->getVar('akses');
            $slugmain = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($namamain['namamain'])));
            $slugsub = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
            $slug = $slugmain . 'X' . $slugsub;
            $isi = $request->getVar('isi');
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $timestamp = date("Y-m-d h:i:sa");
            $penulis = $username;
            $validasi = $this->validate([
                'submenu' => 'required[submenu],'
            ]);
            if (!$validasi) { // Not valid
                session()->setFlashdata('pesanGagal', 'Format isian tidak sesuai');
                return redirect()->to(base_url('/submenu'));
            } else {
                $data = [
                    'urutan' => $urutan,
                    'submenu' => $submenu,
                    'slug' => $slug,
                    'id_mainmenu' => $mainmenu,
                    'content' => $isi,
                    'timestamp' => $timestamp,
                    'penulis' => $penulis,
                    'akses' => $akses,
                ];
                $this->SubmenuModel->update($id, $data);
                session()->setFlashdata('pesanHapus', 'Berhasil diubah !');
                return redirect()->to(base_url('/submenu'));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function hapus($id)
    {
        if (session()->get('level') === 'Superadmin' || session()->get('level') === 'Admin Website') {
            $this->SubmenuModel->delete($id);

            session()->setFlashdata('pesanHapus', 'Berhasil dihapus !');
            return redirect()->to(base_url('/submenu'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}
