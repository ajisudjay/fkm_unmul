<?php

namespace App\Controllers;

use App\Models\KonfigurasiModel;
use App\Models\MainmenuModel;
use App\Models\SubmenuModel;
use App\Models\MitraModel;
use App\Models\SlideshowModel;
use App\Models\PejabatModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\BeritaModel;
use App\Models\LinkModel;
use App\Models\SkModel;
use App\Models\Kategori_skModel;
use App\Models\SemesterModel;

class Pages extends BaseController
{
    protected $MainmenuModel;
    protected $SubmenuModel;
    protected $MitraModel;
    protected $SlideshowModel;
    protected $PejabatModel;
    protected $DosenModel;
    protected $TendikModel;
    protected $KonfigurasiModel;
    protected $BeritaModel;
    protected $LinkModel;
    protected $SkModel;
    protected $Kategori_skModel;
    protected $SemesterModel;
    public function __construct()
    {
        $this->MainmenuModel = new MainmenuModel();
        $this->SubmenuModel = new SubmenuModel();
        $this->MitraModel = new MitraModel();
        $this->SlideshowModel = new SlideshowModel();
        $this->PejabatModel = new PejabatModel();
        $this->DosenModel = new DosenModel();
        $this->TendikModel = new TendikModel();
        $this->KonfigurasiModel = new KonfigurasiModel();
        $this->BeritaModel = new BeritaModel();
        $this->LinkModel = new LinkModel();
        $this->SkModel = new SkModel();
        $this->Kategori_skModel = new Kategori_skModel();
        $this->SemesterModel = new SemesterModel();
    }
    // BEGIN FRONTEND

    public function showFile()
    {
        $uri = current_url(true);
        $total = $uri->getTotalSegments();

        if ($uri->getSegment(2) == 'uploads') {
        }

        if ($total == 3) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            helper("filesystem");
            $path = WRITEPATH . '/uploads/' . $segment3 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 4) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            helper("filesystem");
            $path = WRITEPATH . '/uploads/' . $segment3 . '/' . $segment4 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 5) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            if ($segment2 == 'kjhasdlkjhlkjhasdkhadaskdhj') {
                helper("filesystem");
                $path = WRITEPATH . '/uploads/' . $segment3 . '/' . $segment4 . '/' . $segment5 . '';
                $file = new \CodeIgniter\Files\File($path, true);
                $binary = readfile($path);
                return $this->response
                    ->setHeader('Content-Type', $file->getMimeType())
                    ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                    ->setStatusCode(200)
                    ->setBody($binary);
            } else {
                helper("filesystem");
                $path = WRITEPATH . '/uploads/' . $segment3 . '/' . $segment4 . '/' . $segment5 . '';
                $file = new \CodeIgniter\Files\File($path, true);
                $binary = readfile($path);
                return $this->response
                    ->setHeader('Content-Type', $file->getMimeType())
                    ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                    ->setStatusCode(200)
                    ->setBody($binary);
            }
        } else if ($total == 6) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            $segment6 = $uri->getSegment(6);
            helper("filesystem");
            $path = WRITEPATH . '' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '';
            // dd($path);
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 7) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            $segment6 = $uri->getSegment(6);
            $segment7 = $uri->getSegment(7);
            helper("filesystem");
            $path = WRITEPATH . '' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '/' . $segment7 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 8) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            $segment6 = $uri->getSegment(6);
            $segment7 = $uri->getSegment(7);
            $segment8 = $uri->getSegment(8);
            helper("filesystem");
            $path = WRITEPATH . '' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '/' . $segment7 . '/' . $segment8 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 9) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            $segment6 = $uri->getSegment(6);
            $segment7 = $uri->getSegment(7);
            $segment8 = $uri->getSegment(8);
            $segment9 = $uri->getSegment(9);
            helper("filesystem");
            $path = WRITEPATH . '' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '/' . $segment7 . '/' . $segment8 . '/' . $segment9 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        } else if ($total == 10) {
            $segment2 = $uri->getSegment(2);
            $segment3 = $uri->getSegment(3);
            $segment4 = $uri->getSegment(4);
            $segment5 = $uri->getSegment(5);
            $segment6 = $uri->getSegment(6);
            $segment7 = $uri->getSegment(7);
            $segment8 = $uri->getSegment(8);
            $segment9 = $uri->getSegment(9);
            $segment10 = $uri->getSegment(10);
            helper("filesystem");
            $path = WRITEPATH . '' . $segment3 . '/' . $segment4 . '/' . $segment5 . '/' . $segment6 . '/' . $segment7 . '/' . $segment8 . '/' . $segment9 . '/' . $segment10 . '';
            $file = new \CodeIgniter\Files\File($path, true);
            $binary = readfile($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
                ->setStatusCode(200)
                ->setBody($binary);
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'title_pages' => '',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'berita' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(6),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/beranda', $data);
    }

    public function pages($slug)
    {
        $uri = current_url(true);
        $slugx = $uri->getSegment(3); // Method - instrument
        $cek_menu = $this->SubmenuModel->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->where('slug', $slugx)->first();
        $judul = $cek_menu['mainmenu'];
        $data = [
            'title' => '',
            'title_pages' => $judul,
            'slug'  => $slug,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'content' => $this->SubmenuModel->where('slug', $slugx)->findAll(),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/pages', $data);
    }

    public function dosen()
    {
        $data = [
            'title' => 'SDM',
            'title_pages' => 'Tenaga Pendidik',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'dosens2kesmas' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S2 Kesehatan Masyarakat')->get()->getResultArray(),
            'dosens1kesmas' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S1 Kesehatan Masyarakat')->get()->getResultArray(),
            'dosengizi' => $this->DosenModel->orderBy('nip', 'ASC')->where('homebase', 'S1 Gizi')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/dosen', $data);
    }

    public function dosen_detail($nip)
    {
        $data = [
            'title' => 'Dosen',
            'title_pages' => 'Dosen',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'dosen' => $this->DosenModel->where('nip', $nip)->first(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/dosen-detail', $data);
    }

    public function tendik()
    {
        $data = [
            'title' => 'SDM',
            'title' => 'SDM',
            'title_pages' => 'Tenaga Kependidikan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'tendik' => $this->TendikModel->orderBy('nip', 'ASC')->orderBy('nama', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/tendik', $data);
    }

    public function sk()
    {
        $data = [
            'title' => 'SK',
            'title_pages' => 'Surat Keputusan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'sk' => $this->SkModel->orderBy('tanggal', 'DESC')->select('*')->select('sk.id as id_sk')->select('kategori_sk.kategori as nama_kategori')->select('semester.semester as nama_semester')->join('kategori_sk', 'kategori_sk.id=sk.kategori')->join('semester', 'semester.id=sk.semester')->get()->getResultArray(),
            'kategori_sk' => $this->Kategori_skModel->orderBy('kategori', 'ASC')->get()->getResultArray(),
            'semester' => $this->SemesterModel->orderBy('semester', 'DESC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
        ];
        return view('frontend/pages/sk', $data);
    }

    public function informasi()
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => 'Berita, Artikel dan Kegiatan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'berita' => $this->BeritaModel->first(),
            'berita10' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(10),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('frontend/pages/informasi', $data);
    }

    public function informasi_kategori($kategori)
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'judul'  => $kategori,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'berita_kategori' => $this->BeritaModel->where('kategori', $kategori)->orderBy('tanggal', 'DESC')->findAll(),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('frontend/pages/informasi-kategori', $data);
    }

    public function informasi_lengkap()
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => 'Berita, Artikel dan Kegiatan',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'berita' => $this->BeritaModel->first(),
            'beritalengkap' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(),
            'populer' => $this->BeritaModel->orderBy('dilihat', 'DESC')->findAll(3),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
        ];
        return view('frontend/pages/informasi-lengkap', $data);
    }

    public function informasi_detail($slug)
    {
        $data = [
            'title' => 'Informasi',
            'title_pages' => '',
            'slug'  => $slug,
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'berita' => $this->BeritaModel->where('slug', $slug)->first(),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'konfigurasi' => $this->KonfigurasiModel->first(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
            'link_library' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Library')->findAll(),
            'link_partner' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Partner')->findAll(),
            'link_jurnal' => $this->LinkModel->orderBy('judul', 'ASC')->where('kategori', 'Journal')->findAll(),
            'terbaru' => $this->BeritaModel->orderBy('tanggal', 'DESC')->findAll(3),
        ];
        return view('frontend/pages/informasi-detail', $data);
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu',
            'title_pages' => '',
            'submenu' => $this->SubmenuModel->select('*')->select('submenu.id as submenu_id')->select('mainmenu.id as mainmenu_id')->select('mainmenu.urutan as urutan_mainmenu')->select('submenu.urutan as urutan_submenu')->join('mainmenu', 'submenu.id_mainmenu=mainmenu.id')->orderBy('urutan_mainmenu', 'ASC')->orderBy('urutan_submenu', 'ASC')->get()->getResultArray(),
            'mainmenu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'menu' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(5),
            'menu2' => $this->MainmenuModel->orderBy('urutan', 'ASC')->findAll(6, 5),
            'mitra' => $this->MitraModel->orderBy('nama', 'DESC')->get()->getResultArray(),
            'slideshow' => $this->SlideshowModel->orderBy('nama', 'ASC')->get()->getResultArray(),
            'pejabat' => $this->PejabatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
            'konf' => $this->KonfigurasiModel->findAll(),
            'prodi' => $this->SubmenuModel->orderBy('urutan', 'ASC')->where('id_mainmenu', '25')->findAll(),
        ];
        return view('frontend/pages/menu', $data);
    }
    // END FRONTEND

    // START BACKEND
    public function beranda()
    {
        $admin = session()->get('nama');
        $lvl = session()->get('level');
        $file = session()->get('file');
        if ($file === NULL) {
            $gambar = 'user-profile.png';
        } else {
            $gambar = $file;
        }
        $data = [
            'title' => 'Beranda',
            'lvl' => $lvl,
            'admin' => $admin,
            'foto' => $gambar,
        ];
        return view('backend/pages/beranda', $data);
    }

    public function login()
    {
        $captcha1 = rand(0, 9);
        $captcha2 = rand(0, 9);
        $captcha3 = rand(0, 9);
        $captcha4 = rand(0, 9);
        $captcha = $captcha1 . $captcha2 . $captcha3 . $captcha4;
        $data = [
            'title' => 'Login',
            'captcha' => $captcha,
        ];
        return view('backend/pages/login', $data);
    }
    // END BACKEND
}
