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
            'title' => 'Sub Menu',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
        ];
        return view('backend/submenu/index', $data);
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
            'title' => 'Sub Menu',
            'admin' => $admin,
            'lvl' => $lvl,
            'foto' => $gambar,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->where('submenu.slug', $slug)->first(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
        ];
        return view('backend/submenu/editform', $data);
    }

    public function view()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
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
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $username = session()->get('username');
        $request = \Config\Services::request();
        $urutan = $request->getVar('urutan');
        $mainmenu = $request->getVar('mainmenu');
        $submenu = $request->getVar('submenu');
        $tag = $request->getVar('tag');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
        $content = $request->getVar('isi');
        $timestamp = date("Y-m-d");
        $penulis = $username;
        $data = [
            'urutan' => $urutan,
            'submenu' => $submenu,
            'slug' => $slug,
            'id_mainmenu' => $mainmenu,
            'content' => $content,
            'timestamp' => $timestamp,
            'penulis' => $penulis,
            'tag' => $tag,
        ];
        $this->SubmenuModel->insert($data);

        session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Submenu');
        return redirect()->to(base_url('/submenu'));
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $username = session()->get('username');
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $urutan = $request->getVar('urutan');
        $mainmenu = $request->getVar('mainmenu');
        $submenu = $request->getVar('submenu');
        $tag = $request->getVar('tag');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($submenu)));
        $content = $request->getVar('isi');
        $timestamp = date("Y-m-d");
        $penulis = $username;
        $data = [
            'urutan' => $urutan,
            'submenu' => $submenu,
            'slug' => $slug,
            'id_mainmenu' => $mainmenu,
            'content' => $content,
            'timestamp' => $timestamp,
            'penulis' => $penulis,
            'tag' => $tag,
        ];
        $this->SubmenuModel->update($id, $data);

        session()->setFlashdata('pesanInput', 'Berhasil Mengubah Submenu');
        return redirect()->to(base_url('/submenu'));
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $this->SubmenuModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Submenu Berhasil Di Hapus !');
        return redirect()->to(base_url('/submenu'));
    }
}
